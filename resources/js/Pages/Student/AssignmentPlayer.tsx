import AppShell from '@/Layouts/AppShell';
import { Head, Link } from '@inertiajs/react';
import axios from 'axios';
import { BookOpen, Check, CheckCircle2, ChevronLeft, ChevronRight, Clock, Flag, Lightbulb, Maximize2, Minimize2 } from 'lucide-react';
import { ChangeEvent, ReactNode, useEffect, useMemo, useRef, useState } from 'react';
import { buildLessonHierarchy, isQuestion, LessonItem, LessonSection, normalizeLessonItems } from './lessonHierarchy';

type Json = Record<string, any>;
type Item = LessonItem;
type Answer = { assignment_item_id: number; response_json: Json | null; auto_score?: string | number | null; final_score?: string | number | null; grading_status?: string };
type GradeResult = { final_score: string | number; status: string; released_at?: string | null; general_feedback?: string | null };
type Submission = { id: number; status: string; started_at: string; attempt_number: number; answers: Answer[]; grade?: GradeResult | null };
type Delivery = { id: number; status: string; open_at?: string; due_at?: string; close_at?: string; time_limit_minutes?: number; max_attempts: number; allow_review?: boolean; show_correct_answers?: boolean; assignment_version?: { instructions?: string; total_points?: string | number; assignment?: { title?: string; description?: string }; items?: Item[] }; submissions?: Submission[] };

const itemText = (item: Item) => String(item.content_snapshot_json.prompt || item.content_snapshot_json.statement || item.item_type.replaceAll('_', ' '));
const mediaUrl = (id: unknown, url?: unknown) => String(url || (Number(id) > 0 ? `/media-assets/${Number(id)}/stream` : ''));

function AudioPlayer({ url, title = 'Audio bài học' }: { url?: string; title?: string }) {
    if (!url) return null;
    return <div className="exam-audio-card exam-listening-audio"><div className="exam-audio-icon"><Clock size={20} /></div><div className="flex-1"><p className="text-sm font-semibold text-slate-700">{title}</p><audio className="mt-2 w-full" controls preload="metadata" src={url} /></div></div>;
}

function SubmissionResult({ grade, totalPoints }: { grade?: GradeResult | null; totalPoints: string | number }) {
    if (!grade) return <div className="mt-5 rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 text-sm text-slate-600">Bài làm đã được lưu. Kết quả đang được xử lý.</div>;
    if (String(grade.status) !== 'RELEASED') return <div className="mt-5 rounded-2xl border border-amber-200 bg-amber-50 px-5 py-4 text-sm text-amber-800">Bài làm đã được nộp. Giáo viên sẽ phát hành kết quả sau khi hoàn tất chấm bài.</div>;
    const score = Number(grade.final_score ?? 0);
    const maximum = Number(totalPoints ?? 0);
    const percentage = maximum > 0 ? Math.round((score / maximum) * 100) : null;
    return <div className="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-center"><p className="text-xs font-bold uppercase tracking-[0.18em] text-emerald-700">Kết quả bài làm</p><p className="mt-1 text-3xl font-black text-emerald-800">{score} <span className="text-lg font-semibold text-emerald-700">/ {maximum || '—'}</span></p>{percentage !== null && <p className="mt-1 text-sm font-semibold text-emerald-700">Đạt {percentage}%</p>}{grade.general_feedback && <p className="mt-3 text-sm text-emerald-900">{grade.general_feedback}</p>}</div>;
}

function correctAnswerText(item: Item): string | null {
    const key = item.answer_key_snapshot_json;
    if (!key) return null;
    const content = item.content_snapshot_json;
    const type = item.item_type === 'reading_comprehension' ? String(content.interactionType || 'multiple_choice') : item.item_type;
    const options = Array.isArray(content.options) ? content.options as Json[] : [];
    const optionText = (id: unknown) => {
        const option = options.find((candidate) => String(candidate.id) === String(id));
        return String(option?.text || option?.label || option?.id || id || '');
    };
    if (type === 'multiple_choice' || type === 'dropdown') {
        if (type === 'dropdown') {
            const answers = key.answers as Json | undefined;
            if (answers) return Object.values(answers).map(optionText).filter(Boolean).join(', ');
        }
        return key.correctOptionId !== undefined ? optionText(key.correctOptionId) : null;
    }
    if (type === 'multiple_select') return ((key.correctOptionIds as unknown[]) || []).map(optionText).filter(Boolean).join(', ');
    if (type === 'true_false') return key.correct === true ? 'Đúng' : key.correct === false ? 'Sai' : null;
    if (type === 'fill_blank' || type === 'short_answer') return ((key.acceptedAnswers as unknown[]) || []).map(String).join(' / ') || null;
    if (type === 'matching') {
        const pairs = (content.pairs as Json[] | undefined) || [];
        const matches = (key.matches as Json | undefined) || {};
        return Object.entries(matches).map(([left, right]) => `${pairs.find((pair) => String(pair.id) === left)?.left ?? left} → ${pairs.find((pair) => String(pair.id) === String(right))?.right ?? right}`).join(' · ') || null;
    }
    if (type === 'ordering') {
        const entries = (content.items as Json[] | undefined) || [];
        return ((key.correctOrder as unknown[]) || []).map((id) => String(entries.find((entry) => String(entry.id) === String(id))?.text ?? id)).join(' → ') || null;
    }
    if (type === 'drag_drop') {
        const items = (content.items as Json[] | undefined) || [];
        const targets = (content.targets as Json[] | undefined) || [];
        const mapping = (key.mapping as Json | undefined) || {};
        return Object.entries(mapping).map(([from, to]) => `${items.find((entry) => String(entry.id) === from)?.text ?? from} → ${targets.find((target) => String(target.id) === String(to))?.text ?? to}`).join(' · ') || null;
    }
    return null;
}

function AnswerReview({ item, answer }: { item: Item; answer?: Answer }) {
    const correct = correctAnswerText(item);
    const score = answer?.final_score ?? answer?.auto_score;
    const hasScore = score !== null && score !== undefined;
    const isCorrect = hasScore && Number(score) >= Number(item.points);
    return <div className="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm"><p className={`font-semibold ${hasScore ? (isCorrect ? 'text-emerald-800' : 'text-rose-700') : 'text-slate-700'}`}>{hasScore ? (isCorrect ? 'Đúng' : 'Chưa đúng') : 'Đang chờ chấm'}</p>{correct && <p className="mt-1 text-emerald-900"><span className="font-medium">Đáp án đúng:</span> {correct}</p>}</div>;
}

function ContentBlock({ item }: { item: Item }): ReactNode {
    const c = item.content_snapshot_json;
    if (item.item_type === 'divider') return <hr className="my-3 border-slate-200" />;
    if (item.item_type === 'heading') return <h2 className="text-2xl font-bold text-slate-900">{String(c.text || '')}</h2>;
    if (item.item_type === 'rich_text') return <div className="prose max-w-none" dangerouslySetInnerHTML={{ __html: String(c.html || '') }} />;
    if (item.item_type === 'grammar_explanation') return <div className="rounded-2xl border border-emerald-100 bg-emerald-50 p-5"><p className="text-xs font-bold uppercase tracking-wider text-emerald-700">Grammar tip</p><h3 className="mt-1 text-xl font-bold text-slate-900">{String(c.title || 'Grammar explanation')}</h3><div className="prose mt-3 max-w-none" dangerouslySetInnerHTML={{ __html: String(c.explanation || c.html || '') }} /></div>;
    if (item.item_type === 'callout') return <div className="rounded-2xl border-l-4 border-amber-400 bg-amber-50 p-4 text-amber-950">{String(c.text || '')}</div>;
    if (item.item_type === 'reading_passage') return <div className="exam-passage-card"><h3 className="text-xl font-bold">{String(c.title || 'Reading passage')}</h3>{c.instructions && <p className="mt-2 text-sm text-slate-500">{String(c.instructions)}</p>}<div className="mt-4 whitespace-pre-wrap leading-8 text-slate-700">{String(c.passage || c.text || '')}</div></div>;
    if (item.item_type === 'vocabulary') return <div className="grid gap-3 sm:grid-cols-2">{((c.items as Json[]) || []).map((entry, index) => <div key={String(entry.id || index)} className="rounded-2xl border border-cyan-100 bg-cyan-50/60 p-4"><p className="text-lg font-bold text-slate-900">{String(entry.term || '')}</p>{entry.partOfSpeech && <p className="text-xs italic text-cyan-700">{String(entry.partOfSpeech)}</p>}<p className="mt-1 text-sm text-slate-700">{String(entry.definition || '')}</p>{entry.example && <p className="mt-2 text-sm italic text-slate-500">“{String(entry.example)}”</p>}</div>)}</div>;
    if (item.item_type === 'image') return <figure className="rounded-2xl bg-slate-50 p-3"><img src={String(c.url || c.media_url || (c.mediaAssetId ? `/media-assets/${c.mediaAssetId}/stream` : ''))} alt={String(c.altText || '')} className="max-h-80 w-full rounded-xl object-contain" /><figcaption className="mt-2 text-center text-xs text-slate-500">{String(c.caption || '')}</figcaption></figure>;
    if (item.item_type === 'audio') return <AudioPlayer url={String(c.url || c.audio_url || (c.mediaAssetId ? `/media-assets/${c.mediaAssetId}/stream` : ''))} />;
    if (item.item_type === 'video') return <video controls preload="metadata" className="aspect-video w-full rounded-2xl bg-slate-950" src={String(c.url || c.video_url || (c.mediaAssetId ? `/media-assets/${c.mediaAssetId}/stream` : ''))} />;
    if (item.item_type === 'file') return <a className="btn btn-outline" href={String(c.url || c.file_url || '#')} target="_blank" rel="noreferrer">Mở tài liệu học tập</a>;
    return null;
}

function QuestionInput({ item, value, onChange, readOnly }: { item: Item; value: Json; onChange: (value: Json) => void; readOnly?: boolean }) {
    const c = item.content_snapshot_json;
    const type = item.item_type === 'reading_comprehension' ? String(c.interactionType || 'multiple_choice') : item.item_type;
    const options = Array.isArray(c.options) ? c.options as Json[] : [];
    const displayType = String(item.settings_snapshot_json?.answer_display_type || c.answer_display_type || (options.some(option => option.image_media_id || option.image_url) ? 'image_text' : 'text'));
    const optionContent = (option: Json, index: number, selected: boolean) => { const optionImage = mediaUrl(option.image_media_id || option.imageMediaId || option.mediaAssetId, option.image_url); return <><span className="exam-answer-letter">{String.fromCharCode(65 + index)}</span>{displayType !== 'text' && optionImage && <img src={optionImage} alt="" className="h-20 w-24 rounded-lg object-contain" />}{displayType !== 'image' && <span className="flex-1">{String(option.text || '')}</span>}{selected && <Check size={18} className="exam-answer-check" />}</>; };
    if (type === 'multiple_choice') return <div className="space-y-3">{options.map((option, index) => { const selected = value.selectedOptionId === option.id; return <label key={String(option.id)} className={`exam-answer-row ${selected ? 'is-selected' : ''}`}><input type="radio" name={`item-${item.id}`} disabled={readOnly} checked={selected} onChange={() => onChange({ selectedOptionId: option.id })} />{optionContent(option, index, selected)}</label>; })}</div>;
    if (type === 'multiple_select') return <div className="space-y-3">{options.map((option, index) => { const selected = (value.selectedOptionIds as string[] || []).includes(option.id); return <label key={String(option.id)} className={`exam-answer-row ${selected ? 'is-selected' : ''}`}><input type="checkbox" disabled={readOnly} checked={selected} onChange={(event) => { const ids = [...(value.selectedOptionIds as string[] || [])]; onChange({ selectedOptionIds: event.target.checked ? [...ids, option.id] : ids.filter((id) => id !== option.id) }); }} />{optionContent(option, index, selected)}</label>; })}</div>;
    if (type === 'true_false') return <div className="grid grid-cols-2 gap-3">{[true, false].map((answer) => <button type="button" disabled={readOnly} key={String(answer)} onClick={() => onChange({ value: answer })} className={`exam-binary ${value.value === answer ? 'is-selected' : ''}`}>{answer ? 'Đúng' : 'Sai'}{value.value === answer && <Check size={18} />}</button>)}</div>;
    if (type === 'fill_blank' || type === 'short_answer' || type === 'open_response') return <textarea readOnly={readOnly} className="field exam-writing-field" value={String(value.text || '')} onChange={(event) => onChange({ text: event.target.value })} aria-label="Câu trả lời" />;
    if (type === 'dropdown') return <select className="field" disabled={readOnly} value={String(value.value || '')} onChange={(event) => onChange({ value: event.target.value })}><option value="">Chọn đáp án</option>{options.map((option) => <option key={String(option.id)} value={String(option.id)}>{String(option.text || option.id)}</option>)}</select>;
    if (type === 'matching') return <div className="space-y-2">{((c.pairs as Json[]) || []).map((pair) => <label key={String(pair.id)} className="flex items-center gap-3"><span className="flex-1 rounded-lg bg-slate-50 p-2 text-sm">{String(pair.left || '')}</span><select className="field max-w-48" disabled={readOnly} value={String((value.matches || {})[pair.id] || '')} onChange={(event) => onChange({ matches: { ...(value.matches || {}), [pair.id]: event.target.value } })}><option value="">Chọn</option>{((c.pairs as Json[]) || []).map((option) => <option key={String(option.id)} value={String(option.id)}>{String(option.right || '')}</option>)}</select></label>)}</div>;
    if (type === 'ordering') return <div className="space-y-2">{((c.items as Json[]) || []).map((entry, index) => <label key={String(entry.id)} className="flex items-center gap-3"><span className="w-7 text-center font-bold text-slate-500">{index + 1}</span><select className="field" disabled={readOnly} value={String((value.order || [])[index] || '')} onChange={(event) => { const order = [...(value.order || [])]; order[index] = event.target.value; onChange({ order }); }}><option value="">Chọn mục</option>{((c.items as Json[]) || []).map((option) => <option key={String(option.id)} value={String(option.id)}>{String(option.text || '')}</option>)}</select></label>)}</div>;
    if (type === 'drag_drop') return <div className="space-y-2">{((c.items as Json[]) || []).map((entry) => <label key={String(entry.id)} className="flex items-center gap-3"><span className="flex-1 rounded-lg bg-slate-50 p-2 text-sm">{String(entry.text || '')}</span><select className="field max-w-48" disabled={readOnly} value={String((value.mapping || {})[entry.id] || '')} onChange={(event) => onChange({ mapping: { ...(value.mapping || {}), [entry.id]: event.target.value } })}><option value="">Chọn đích</option>{((c.targets as Json[]) || []).map((target) => <option key={String(target.id)} value={String(target.id)}>{String(target.text || '')}</option>)}</select></label>)}</div>;
    return <textarea readOnly={readOnly} className="field min-h-28 font-mono text-xs" value={JSON.stringify(value, null, 2)} onChange={(event: ChangeEvent<HTMLTextAreaElement>) => { try { onChange(JSON.parse(event.target.value)); } catch { /* keep last valid response */ } }} aria-label="Câu trả lời" />;
}

function QuestionCard({ item, index, value, answer, readOnly, showResult, onChange }: { item: Item; index: number; value: Json; answer?: Answer; readOnly: boolean; showResult?: boolean; onChange: (value: Json) => void }) {
    const questionImage = mediaUrl(item.content_snapshot_json.question_image_media_id || item.content_snapshot_json.questionImageMediaId, item.content_snapshot_json.question_image_url);
    return <article className="exam-question"><div className="exam-question-heading"><div><p className="exam-question-number">Câu {index + 1} <span>· {item.points} điểm</span></p><h2>{itemText(item)}</h2></div><Flag size={17} className="text-slate-400" aria-hidden="true" /></div>{questionImage && <img src={questionImage} alt="Minh họa câu hỏi" className="mb-4 max-h-56 w-full rounded-xl object-contain" />}<QuestionInput item={item} value={value} onChange={onChange} readOnly={readOnly} />{showResult && <AnswerReview item={item} answer={answer} />}</article>;
}

function ListeningExampleCard({ example }: { example?: Json | null }) {
    if (!example?.enabled) return null;
    const displayType = String(example.answer_display_type || 'text');
    const options = Array.isArray(example.options) ? example.options as Json[] : [];
    const exampleImage = mediaUrl(example.question_image_media_id || example.questionImageMediaId);
    return <div className="mt-5 rounded-2xl border-2 border-dashed border-amber-300 bg-amber-50/80 p-4"><div className="flex items-center justify-between gap-2"><div><span className="rounded-full bg-amber-400 px-2.5 py-1 text-[10px] font-black uppercase tracking-wider text-amber-950">Example</span><p className="mt-2 text-xs font-semibold text-amber-800">Try this one first</p></div><CheckCircle2 size={22} className="text-amber-600" /></div><p className="mt-3 font-bold text-slate-900">{String(example.question || '')}</p>{exampleImage && <img src={exampleImage} alt="Minh họa example" className="mt-3 max-h-40 w-full rounded-xl object-contain" />}<div className="mt-3 grid gap-2">{options.map((option, index) => { const correct = String(option.id) === String(example.correctOptionId); const image = mediaUrl(option.image_media_id || option.imageMediaId || option.mediaAssetId, option.image_url); return <div key={String(option.id)} className={`flex items-center gap-2 rounded-xl border px-3 py-2 text-sm ${correct ? 'border-emerald-400 bg-emerald-50 text-emerald-900' : 'border-amber-200 bg-white text-slate-700'}`}><strong>{String.fromCharCode(65 + index)}</strong>{displayType !== 'text' && image && <img src={image} alt="" className="h-12 w-16 rounded-lg object-contain" />}{displayType !== 'image' && <span className="flex-1">{String(option.text || '')}</span>}{correct && <span className="text-xs font-bold">✓ Correct</span>}</div>; })}</div></div>;
}

export default function AssignmentPlayer({ delivery }: { delivery: Delivery }) {
    const assignmentVersion = delivery.assignment_version || {};
    const assignment = assignmentVersion.assignment || {};
    const assignmentTitle = assignment.title || 'Bài học tiếng Anh';
    const assignmentDescription = assignmentVersion.instructions || assignment.description || '';
    const rawSubmissions = delivery.submissions || [];
    const allItems = useMemo(() => normalizeLessonItems(assignmentVersion.items || []), [assignmentVersion.items]);
    const sections = useMemo(() => buildLessonHierarchy(allItems), [allItems]);
    const questionItems = useMemo(() => allItems.filter(isQuestion), [allItems]);
    // Only an active attempt should open directly in the player. A previous
    // submitted/graded attempt must not block the Start screen when the
    // delivery still has attempts remaining; the API will create the next
    // attempt atomically.
    const initialSubmission = rawSubmissions.find((candidate) => ['IN_PROGRESS', 'RETURNED'].includes(String(candidate.status)));
    const [submission, setSubmission] = useState<Submission | undefined>(initialSubmission);
    const initial = Object.fromEntries((submission?.answers || []).map((answer) => [answer.assignment_item_id, answer.response_json || {}]));
    const [answers, setAnswers] = useState<Record<number, Json>>(initial);
    const [saved, setSaved] = useState<Record<number, string>>({});
    const [sectionIndex, setSectionIndex] = useState(0);
    const [activityIndex, setActivityIndex] = useState(0);
    const [questionIndex, setQuestionIndex] = useState(0);
    const [flipDirection, setFlipDirection] = useState<'next' | 'prev'>('next');
    const [confirm, setConfirm] = useState(false);
    const [receipt, setReceipt] = useState(false);
    const [reviewSubmitted, setReviewSubmitted] = useState(false);
    const [focusMode, setFocusMode] = useState(false);
    const [fullscreen, setFullscreen] = useState(false);
    const timers = useRef<Record<number, ReturnType<typeof setTimeout>>>({});
    const [now, setNow] = useState(Date.now());
    const [starting, setStarting] = useState(false);
    const [startError, setStartError] = useState<string | null>(null);
    useEffect(() => { const timer = setInterval(() => setNow(Date.now()), 1000); return () => clearInterval(timer); }, []);
    useEffect(() => { document.body.classList.toggle('review-submitted', reviewSubmitted); return () => document.body.classList.remove('review-submitted'); }, [reviewSubmitted]);
    useEffect(() => { document.body.classList.remove('page-turn-next', 'page-turn-prev'); const frame = requestAnimationFrame(() => document.body.classList.add(`page-turn-${flipDirection}`)); return () => { cancelAnimationFrame(frame); document.body.classList.remove('page-turn-next', 'page-turn-prev'); }; }, [sectionIndex, activityIndex, questionIndex, flipDirection]);

    const fallbackActivity = { id: 'lesson:activity', title: 'Bài học', skill: 'PRACTICE', position: 0, items: allItems };
    const currentSection: LessonSection = sections[sectionIndex] || { id: 'lesson', title: 'Bài học', skill: 'MIXED', position: 0, activities: [fallbackActivity] };
    const currentActivity = currentSection.activities[activityIndex] || currentSection.activities[0] || fallbackActivity;
    const currentItems = currentActivity.items || [];
    const currentQuestions = currentItems.filter(isQuestion);
    const currentQuestion = currentQuestions[questionIndex];
    const answered = questionItems.filter((item) => answers[item.id] && Object.keys(answers[item.id]).length).length;
    const progress = questionItems.length ? Math.round(answered / questionItems.length * 100) : 0;
    const deadline = submission && delivery.time_limit_minutes ? new Date(submission.started_at).getTime() + Number(delivery.time_limit_minutes) * 60000 : delivery.due_at ? new Date(delivery.due_at).getTime() : null;
    const remaining = deadline ? Math.max(0, Math.floor((deadline - now) / 1000)) : null;
    const openAt = delivery.open_at ? new Date(delivery.open_at) : null;
    const notOpen = Boolean(openAt && openAt.getTime() > now);
    const attemptsExhausted = !submission && rawSubmissions.length >= Number(delivery.max_attempts || 1);
    // The API is the authority for schedule checks. Do not disable the
    // button solely from the browser clock (which can differ from the
    // server/container timezone); let the request return the precise
    // validation message instead of making the student click repeatedly.
    const startBlocked = attemptsExhausted;
    const start = async () => { if (starting || startBlocked) return; setStarting(true); setStartError(null); try { const response = await axios.post(`/student/assignments/${delivery.id}/start`); const payload = response.data?.data; const nextSubmission = (payload?.submission || payload) as Submission | undefined; if (!nextSubmission || !nextSubmission.id) throw new Error('Invalid submission response'); setSubmission(nextSubmission); if (Array.isArray(nextSubmission.answers)) setAnswers(Object.fromEntries(nextSubmission.answers.map((answer) => [answer.assignment_item_id, answer.response_json || {}]))); } catch (error) { const payload = (error as { response?: { data?: { message?: string; errors?: Record<string, string | string[]> } } }).response?.data; const details = payload?.errors ? Object.values(payload.errors).flatMap((message) => Array.isArray(message) ? message : [message]).join(' ') : null; setStartError(details || payload?.message || 'Không thể bắt đầu bài học. Vui lòng thử lại sau.'); } finally { setStarting(false); } };
    const save = async (itemId: number, response = answers[itemId] || {}) => { if (!submission || ['SUBMITTED', 'LATE', 'GRADED'].includes(submission.status) || reviewSubmitted) return; setSaved((state) => ({ ...state, [itemId]: 'saving' })); try { await axios.put(`/student/submissions/${submission.id}/answer`, { assignment_item_id: itemId, response }); setSaved((state) => ({ ...state, [itemId]: 'saved' })); } catch { setSaved((state) => ({ ...state, [itemId]: 'failed' })); } };
    const change = (itemId: number, value: Json) => { if (submission && ['SUBMITTED', 'LATE', 'GRADED'].includes(submission.status)) return; setAnswers((state) => ({ ...state, [itemId]: value })); setSaved((state) => ({ ...state, [itemId]: 'unsaved' })); clearTimeout(timers.current[itemId]); timers.current[itemId] = setTimeout(() => save(itemId, value), 700); };
    const submit = async () => { if (!submission || reviewSubmitted) return; await Promise.all(questionItems.map((item) => save(item.id, answers[item.id] || {}))); const response = await axios.post(`/student/submissions/${submission.id}/submit`); const completed = response.data?.data as Submission; setConfirm(false); setReceipt(true); setSubmission({ ...completed, answers: completed.answers || submission.answers }); };
    const activate = (section: number, activity: number, question = 0, direction: 'next' | 'prev' = 'next') => { setFlipDirection(direction); setSectionIndex(section); setActivityIndex(activity); setQuestionIndex(question); };
    const moveQuestion = (next: number) => {
        const direction = next >= questionIndex ? 'next' : 'prev';
        if (next >= 0 && next < currentQuestions.length) return activate(sectionIndex, activityIndex, next, direction);
        if (next >= currentQuestions.length) {
            if (activityIndex < currentSection.activities.length - 1) return activate(sectionIndex, activityIndex + 1, 0, 'next');
            if (sectionIndex < sections.length - 1) return activate(sectionIndex + 1, 0, 0, 'next');
        }
        if (next < 0) {
            if (activityIndex > 0) { const previous = currentSection.activities[activityIndex - 1].items.filter(isQuestion); return activate(sectionIndex, activityIndex - 1, Math.max(0, previous.length - 1), 'prev'); }
            if (sectionIndex > 0) { const previousSection = sections[sectionIndex - 1]; const previousActivity = previousSection.activities[previousSection.activities.length - 1]; return activate(sectionIndex - 1, previousSection.activities.length - 1, Math.max(0, previousActivity.items.filter(isQuestion).length - 1), 'prev'); }
        }
    };
    const toggleFullscreen = async () => { if (!document.fullscreenElement) { await document.documentElement.requestFullscreen?.(); setFullscreen(true); } else { await document.exitFullscreen?.(); setFullscreen(false); } };
    if (receipt) return <AppShell><Head title="Đã nhận bài nộp" /><div className="exam-page"><div className="exam-board exam-completion"><CheckCircle2 size={58} className="text-emerald-500" /><h1>Hoàn thành bài làm!</h1><p>Câu trả lời đã được lưu và nộp thành công.</p><SubmissionResult grade={submission?.grade} totalPoints={assignmentVersion.total_points || 0} /><div className="mt-5 flex flex-wrap justify-center gap-3">{delivery.allow_review && <button className="btn btn-secondary btn-lg" onClick={() => { setReceipt(false); setReviewSubmitted(true); }}>Xem lại bài đã nộp</button>}{submission?.grade?.status === 'RELEASED' && <Link href="/student/grades" className="btn btn-secondary btn-lg">Xem bảng điểm</Link>}<Link href="/student/assignments" className="btn btn-primary btn-lg">Quay lại bài học</Link></div></div></div></AppShell>;
    if (!submission) return <AppShell><Head title={assignmentTitle} /><div className="exam-page"><div className="exam-board exam-start"><div className="exam-brand"><BookOpen size={22} /> Phòng luyện Tiếng Anh</div><h1>{assignmentTitle}</h1><p>{assignmentDescription}</p>{notOpen && openAt && <div role="status" className="mt-4 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm font-medium text-amber-800">Bài học sẽ mở lúc {openAt.toLocaleString('vi-VN')}. Bạn vẫn có thể bấm để kiểm tra trạng thái mới nhất.</div>}{attemptsExhausted && <div role="status" className="mt-4 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-700">Bạn đã sử dụng hết số lần làm bài được phép.</div>}{startError && <div role="alert" className="mt-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800">{startError}</div>}<button type="button" className="btn btn-primary btn-lg mt-5" disabled={starting || startBlocked} onClick={start}>{starting ? 'Đang mở bài…' : notOpen ? 'Kiểm tra và bắt đầu' : attemptsExhausted ? 'Đã hết lượt làm' : 'Bắt đầu làm bài'}{!starting && !startBlocked && <ChevronRight size={18} />}</button></div></div></AppShell>;
    if (['SUBMITTED', 'LATE', 'GRADED'].includes(submission.status) && !reviewSubmitted) return <AppShell><Head title={assignmentTitle} /><div className="exam-page"><div className="exam-board exam-completion"><CheckCircle2 size={58} className="text-emerald-500" /><h1>Bài làm đã được nộp</h1><p>Bài làm đã khóa và không thể chỉnh sửa.</p><SubmissionResult grade={submission.grade} totalPoints={assignmentVersion.total_points || 0} /><div className="mt-5 flex flex-wrap gap-3">{delivery.allow_review && <button className="btn btn-secondary btn-lg" onClick={() => setReviewSubmitted(true)}>Xem lại bài đã nộp</button>}{submission.grade?.status === 'RELEASED' && <Link href="/student/grades" className="btn btn-secondary btn-lg">Xem bảng điểm</Link>}<Link href="/student/assignments" className="btn btn-primary btn-lg">Quay lại bài học</Link></div></div></div></AppShell>;
    const readingGroupSource = currentItems.find((item) => typeof item.content_snapshot_json.reading_passage === 'string' || typeof item.settings_snapshot_json?.reading_passage === 'string');
    const readingPassageText = String(currentItems.find((item) => item.item_type === 'reading_passage')?.content_snapshot_json.passage || readingGroupSource?.content_snapshot_json.reading_passage || readingGroupSource?.settings_snapshot_json?.reading_passage || '');
    const passage = currentItems.find((item) => item.item_type === 'reading_passage') || (readingGroupSource && ({ ...readingGroupSource, id: -1, item_type: 'reading_passage', content_snapshot_json: { title: readingGroupSource.content_snapshot_json.reading_title || readingGroupSource.settings_snapshot_json?.reading_title, instructions: readingGroupSource.content_snapshot_json.reading_instructions || readingGroupSource.settings_snapshot_json?.reading_instructions, passage: readingPassageText } } as Item));
    const audioItem = currentItems.find((item) => typeof item.content_snapshot_json.listening_audio_url === 'string' || typeof item.content_snapshot_json.audio_url === 'string' || item.item_type === 'audio');
    const audioUrl = String(audioItem?.content_snapshot_json.listening_audio_url || audioItem?.content_snapshot_json.audio_url || '');
    const listeningSettings = audioItem?.settings_snapshot_json || {};
    const listeningIllustration = mediaUrl(listeningSettings.listening_illustration_media_id || audioItem?.content_snapshot_json.listening_illustration_media_id, listeningSettings.listening_illustration_url);
    const listeningExample = listeningSettings.listening_example as Json | null | undefined;
    const isListening = currentActivity.skill === 'LISTENING' || Boolean(audioUrl);
    const isReading = currentActivity.skill === 'READING' || Boolean(passage) || Boolean(readingPassageText);
    const globalQuestionNumber = currentQuestion ? questionItems.findIndex((item) => item.id === currentQuestion.id) : 0;
    return <AppShell><Head title={assignmentTitle} /><div className={`exam-page ${focusMode ? 'focus-mode' : ''}`}><div className="exam-board"><header className="exam-topbar"><div className="exam-title-block"><span className="exam-badge"><BookOpen size={16} /> Part {sectionIndex + 1} · {currentActivity.title}</span><h1>{assignmentTitle}</h1><p>{assignmentDescription}</p></div><div className="exam-progress-wrap"><div className="exam-progress-meta"><span>Tiến độ bài làm</span><strong>{answered} / {questionItems.length}</strong></div><div className="exam-progress-track"><div className="exam-progress-fill" style={{ width: `${progress}%` }} /></div></div><div className="exam-tools"><button type="button" className="exam-icon-button" onClick={() => setFocusMode((value) => !value)} aria-label="Chế độ tập trung"><Lightbulb size={19} /></button><button type="button" className="exam-icon-button" onClick={toggleFullscreen} aria-label="Toàn màn hình">{fullscreen ? <Minimize2 size={19} /> : <Maximize2 size={19} />}</button>{remaining !== null && <div className={`exam-timer ${remaining < 300 ? 'is-warning' : ''}`}><Clock size={17} /><span><small>Thời gian còn lại</small><strong>{Math.floor(remaining / 60)}:{String(remaining % 60).padStart(2, '0')}</strong></span></div>}</div></header><nav className="exam-section-tabs" aria-label="Các phần bài học">{sections.map((section, index) => <button key={section.id} type="button" className={index === sectionIndex ? 'is-active' : ''} onClick={() => activate(index, 0, 0, index >= sectionIndex ? 'next' : 'prev')}>{`Part ${index + 1}`}<span>{section.title}</span></button>)}</nav><nav className="exam-activity-tabs" aria-label="Nhóm hoạt động trong phần">{currentSection.activities.map((activity, index) => <button key={activity.id} type="button" className={index === activityIndex ? 'is-active' : ''} onClick={() => activate(sectionIndex, index, 0, index >= activityIndex ? 'next' : 'prev')}>{activity.title}<span>{activity.skill}</span></button>)}</nav><div className={`exam-content ${isReading || isListening ? 'has-reading' : ''} ${isReading && !isListening ? 'is-reading' : ''}`}>{(isReading || isListening) && <aside className="exam-passage">{isListening ? <><span className="exam-part-label">{currentActivity.title}</span><p className="exam-instruction">{String(listeningSettings.listening_instructions || 'Nghe audio và trả lời các câu hỏi.')}</p>{listeningIllustration && <img src={listeningIllustration} alt="Minh họa bài nghe" className="mb-4 max-h-64 w-full rounded-2xl object-contain" />}<AudioPlayer url={audioUrl || mediaUrl(listeningSettings.listening_audio_asset_id)} title="Audio dùng chung cho hoạt động này" /><ListeningExampleCard example={listeningExample} />{currentItems.filter((item) => !isQuestion(item) && item.id !== audioItem?.id).map((item) => <div key={item.id} className="mt-4"><ContentBlock item={item} /></div>)}</> : passage && <ContentBlock item={passage} />}</aside>}<section className="exam-questions">{currentItems.filter((item) => !passage || item.id !== passage.id).filter((item) => isQuestion(item) ? item.id === currentQuestion?.id : !isReading && !isListening).map((item) => isQuestion(item) ? <QuestionCard key={item.id} item={item} index={globalQuestionNumber} value={answers[item.id] || {}} answer={submission?.answers?.find((answer) => answer.assignment_item_id === item.id)} showResult={reviewSubmitted && Boolean(delivery.show_correct_answers)} readOnly={reviewSubmitted} onChange={(value) => change(item.id, value)} /> : <ContentBlock key={item.id} item={item} />)}{currentQuestions.length > 0 && <div className="exam-question-dots">{currentQuestions.map((item, index) => <button key={item.id} type="button" className={index === questionIndex ? 'is-active' : answers[item.id] ? 'is-answered' : ''} onClick={() => activate(sectionIndex, activityIndex, index, index >= questionIndex ? 'next' : 'prev')}>{index + 1}</button>)}</div>}{currentQuestion && <p className="exam-save-status">{saved[currentQuestion.id] === 'saving' ? 'Đang lưu…' : saved[currentQuestion.id] === 'failed' ? 'Lưu thất bại · thử lại' : saved[currentQuestion.id] === 'saved' ? 'Đã lưu ✓' : ''}</p>}</section></div><footer className="exam-footer"><button type="button" className="exam-nav-button" onClick={() => moveQuestion(questionIndex - 1)} disabled={sectionIndex === 0 && activityIndex === 0 && questionIndex === 0}><ChevronLeft size={22} /> Câu trước</button><p><strong>{answered}</strong> / {questionItems.length} câu đã trả lời</p><button type="button" className="exam-nav-button" onClick={() => moveQuestion(questionIndex + 1)} disabled={sectionIndex === sections.length - 1 && activityIndex === currentSection.activities.length - 1 && questionIndex >= currentQuestions.length - 1}>Câu tiếp <ChevronRight size={22} /></button>{!reviewSubmitted && <button type="button" className="btn btn-primary btn-lg exam-submit" onClick={() => setConfirm(true)}>Nộp bài</button>}</footer></div>{confirm && <div className="exam-dialog-backdrop"><div className="exam-dialog" role="dialog" aria-modal="true"><h2>Nộp bài làm?</h2><p>{questionItems.length} câu hỏi · đã trả lời {answered} câu.</p><div className="exam-dialog-actions"><button className="btn btn-secondary" onClick={() => setConfirm(false)}>Tiếp tục</button><button className="btn btn-primary" onClick={submit}>Xác nhận nộp</button></div></div></div>}</div></AppShell>;
}
