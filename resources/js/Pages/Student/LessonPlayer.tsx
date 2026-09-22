import AppShell from '@/Layouts/AppShell';
import { Card, PageHeader } from '@/Components/ui';
import { Head } from '@inertiajs/react';

type Block = { id?: number; block_type: string; content_json: Record<string, unknown>; settings_json?: Record<string, unknown> | null; position?: number };

const blockSkill = (block: Block) => { const explicit = String(block.settings_json?.activity_group_type || block.settings_json?.skill || '').toUpperCase(); if (explicit && explicit !== 'MIXED') return explicit; return (['listening_question', 'audio'].includes(block.block_type) ? 'LISTENING' : ['reading_passage', 'reading_comprehension'].includes(block.block_type) ? 'READING' : block.block_type === 'open_response' ? 'WRITING' : block.block_type === 'speaking_prompt' ? 'SPEAKING' : block.block_type === 'grammar_explanation' ? 'GRAMMAR' : block.block_type === 'vocabulary' ? 'VOCABULARY' : 'PRACTICE'); };

const activityKey = (block: Block, index: number) => String(block.settings_json?.activity_group_id || block.settings_json?.listening_group_id || block.settings_json?.reading_group_id || `activity:${blockSkill(block)}:${block.id || index}`);

function ActivityRenderer({ activity }: { activity: { title: string; skill: string; blocks: Block[] } }) {
    const reading = activity.skill === 'READING';
    const listening = activity.skill === 'LISTENING';
    const passage = activity.blocks.find((block) => block.block_type === 'reading_passage');
    const audio = activity.blocks.find((block) => block.block_type === 'audio' || typeof block.content_json.audio_url === 'string' || typeof block.content_json.listening_audio_url === 'string');
    const content = activity.blocks.filter((block) => block !== passage && block !== audio);
    return <article className="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7"><div className="mb-5 flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 pb-4"><div><p className="text-xs font-bold uppercase tracking-[.16em] text-indigo-600">{activity.skill}</p><h3 className="mt-1 text-xl font-bold text-slate-900">{activity.title}</h3></div><span className="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">{activity.blocks.length} khối</span></div>{listening && <div className="mb-5 rounded-xl border border-indigo-100 bg-indigo-50/60 p-4"><p className="font-semibold text-indigo-900">Listening activity</p><p className="mt-1 text-sm text-indigo-700">Audio và toàn bộ câu hỏi thuộc activity này được giữ cùng một nhóm.</p></div>}<div className={reading || listening ? 'grid gap-6 lg:grid-cols-2' : 'space-y-5'}>{(reading || listening) && <div className="rounded-xl bg-slate-50 p-4">{passage && <Render block={passage} />}{audio && <div className="mt-4"><Render block={audio} /></div>}{listening && !audio && <p className="text-sm text-slate-500">Audio/media của activity được hiển thị ở đây.</p>}</div>}<div className="space-y-5">{content.map((block, index) => <Render key={String(block.id || index)} block={block} />)}</div></div></article>;
}

function renderActivities(children: Block[]) {
    const groups: Array<{ id: string; title: string; skill: string; blocks: Block[] }> = [];
    children.slice().sort((a, b) => (a.position || 0) - (b.position || 0)).forEach((block, index) => {
        const id = activityKey(block, index);
        const skill = blockSkill(block);
        const existing = groups.find((group) => group.id === id);
        if (existing) existing.blocks.push(block);
        else groups.push({ id, title: String(block.settings_json?.activity_group_title || (block.content_json.title as string) || skill.replaceAll('_', ' ')), skill, blocks: [block] });
    });
    return groups;
}

function Render({ block }: { block: Block }) {
    const c = block.content_json;
    if (block.block_type === 'section') { const groups = renderActivities((c.children as Block[]) || []); return <section className="rounded-2xl border-2 border-indigo-100 bg-indigo-50/40 p-5 sm:p-7"><div className="mb-5 border-b border-indigo-100 pb-4"><p className="text-xs font-bold uppercase tracking-[.16em] text-indigo-600">{String(c.skill || 'MIXED')}</p><h2 className="mt-1 text-2xl font-bold text-slate-900">{String(c.title || 'Part')}</h2>{c.subtitle != null && <p className="mt-2 text-sm text-slate-600">{String(c.subtitle)}</p>}</div><div className="space-y-5">{groups.map((activity) => <ActivityRenderer key={activity.id} activity={activity} />)}</div></section>; }
    if (block.block_type === 'heading') return <h2 className="text-2xl font-semibold">{String(c.text ?? '')}</h2>;
    if (block.block_type === 'rich_text') return <div className="prose max-w-none" dangerouslySetInnerHTML={{ __html: String(c.html ?? '') }} />;
    if (block.block_type === 'reading_passage') return <div><h3 className="text-lg font-semibold">{String(c.title ?? 'Reading passage')}</h3><p className="mt-3 whitespace-pre-wrap leading-7 text-slate-700">{String(c.passage ?? c.html ?? '')}</p>{c.instructions != null && <p className="mt-3 text-sm text-slate-500">{String(c.instructions)}</p>}</div>;
    if (block.block_type === 'grammar_explanation') return <div><h3 className="text-lg font-semibold">{String(c.title ?? 'Grammar explanation')}</h3><div className="prose mt-3 max-w-none" dangerouslySetInnerHTML={{ __html: String(c.explanation ?? c.html ?? '') }} /></div>;
    if (block.block_type === 'divider') return <hr />;
    if (block.block_type === 'callout') return <div className="rounded-xl border-l-4 border-teal-500 bg-teal-50 p-4">{String(c.text ?? '')}</div>;
    if (block.block_type === 'vocabulary') return <dl className="grid gap-3 sm:grid-cols-2">{(c.items as Array<{ id: string; term: string; definition: string }> ?? []).map((item) => <div key={item.id} className="rounded-xl bg-slate-50 p-4"><dt className="font-semibold">{item.term}</dt><dd className="mt-1 text-sm text-slate-600">{item.definition}</dd></div>)}</dl>;
    if (['image', 'audio', 'video', 'file'].includes(block.block_type)) return <p className="text-sm text-slate-500">Authorized {block.block_type} asset #{String(c.mediaAssetId ?? '')}</p>;
    return <div><p className="font-medium">{String(c.prompt ?? c.instructions ?? 'Interactive activity')}</p>{Array.isArray(c.options) && <div className="mt-3 space-y-2">{(c.options as Array<{ id: string; text: string }>).map((option) => <label key={option.id} className="flex min-h-11 items-center gap-3 rounded-xl border border-slate-200 p-3"><input type="radio" disabled />{option.text}</label>)}</div>}<p className="mt-3 text-sm text-slate-500">Complete interactive questions inside an assignment.</p></div>;
}

export default function LessonPlayer({ lesson, preview = false }: { lesson: { id: number; title: string; description?: string; blocks: Block[] }; preview?: boolean }) {
    return <AppShell><Head title={preview ? `Preview · ${lesson.title}` : lesson.title} /><div className="mx-auto max-w-4xl">{preview && <div className="mb-4 rounded-xl border border-indigo-200 bg-indigo-50 px-4 py-3 text-sm text-indigo-800">Student preview — answers and submissions are disabled.</div>}<PageHeader title={lesson.title} description={lesson.description} /><div className="mt-6 space-y-4">{lesson.blocks.map((block) => <Card key={block.id} className="p-5 sm:p-7"><Render block={block} /></Card>)}</div></div></AppShell>;
}
