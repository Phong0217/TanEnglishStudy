export type Json = Record<string, any>;

export type LessonItem = {
    id: number;
    item_type: string;
    source_lesson_block_id?: number | null;
    content_snapshot_json: Json;
    answer_key_snapshot_json?: Json | null;
    settings_snapshot_json?: Json;
    points: string;
    position: number;
};

/** Normalize persisted JSON snapshots before they reach the player renderer. */
export const normalizeLessonItems = (value: unknown): LessonItem[] => {
    if (!Array.isArray(value)) return [];

    return value
        .filter((candidate): candidate is Record<string, any> => Boolean(candidate && typeof candidate === 'object'))
        .map((candidate, index) => ({
            id: Number.isFinite(Number(candidate.id)) ? Number(candidate.id) : -(index + 1),
            item_type: String(candidate.item_type || 'rich_text'),
            source_lesson_block_id: candidate.source_lesson_block_id == null ? null : Number(candidate.source_lesson_block_id),
            content_snapshot_json: candidate.content_snapshot_json && typeof candidate.content_snapshot_json === 'object' && !Array.isArray(candidate.content_snapshot_json) ? candidate.content_snapshot_json : {},
            answer_key_snapshot_json: candidate.answer_key_snapshot_json && typeof candidate.answer_key_snapshot_json === 'object' && !Array.isArray(candidate.answer_key_snapshot_json) ? candidate.answer_key_snapshot_json : null,
            settings_snapshot_json: candidate.settings_snapshot_json && typeof candidate.settings_snapshot_json === 'object' && !Array.isArray(candidate.settings_snapshot_json) ? candidate.settings_snapshot_json : {},
            points: String(candidate.points ?? 0),
            position: Number.isFinite(Number(candidate.position)) ? Number(candidate.position) : index + 1,
        }))
        .sort((a, b) => a.position - b.position || a.id - b.id);
};

export type LessonActivity = {
    id: string;
    title: string;
    skill: string;
    position: number;
    items: LessonItem[];
};

export type LessonSection = {
    id: string;
    title: string;
    skill: string;
    position: number;
    activities: LessonActivity[];
};

const contentTypes = new Set(['heading', 'rich_text', 'grammar_explanation', 'callout', 'divider', 'image', 'audio', 'video', 'file', 'reading_passage', 'vocabulary']);

export const isQuestion = (item: LessonItem) => !contentTypes.has(item.item_type);

const inferredSkill = (item: LessonItem, settings: Json) => {
    const explicit = String(settings.activity_group_type || settings.skill || '').toUpperCase();
    if (explicit && explicit !== 'MIXED') return explicit;
    if (settings.listening_group_id || typeof item.content_snapshot_json.listening_audio_url === 'string') return 'LISTENING';
    if (settings.reading_group_id || item.item_type === 'reading_passage' || item.item_type === 'reading_comprehension') return 'READING';
    if (item.item_type === 'open_response') return 'WRITING';
    if (item.item_type === 'speaking_prompt') return 'SPEAKING';
    if (item.item_type === 'grammar_explanation') return 'GRAMMAR';
    if (item.item_type === 'vocabulary') return 'VOCABULARY';
    return 'PRACTICE';
};

export const buildLessonHierarchy = (items: LessonItem[]): LessonSection[] => {
    const safeItems = normalizeLessonItems(items);
    const sections = new Map<string, LessonSection>();
    safeItems.forEach((item) => {
        const settings = item.settings_snapshot_json || {};
        const sectionId = String(settings.section_id || 'lesson');
        const section = sections.get(sectionId) || {
            id: sectionId,
            title: String(settings.section_title || 'Bài học'),
            skill: String(settings.section_skill || 'MIXED'),
            position: Number(settings.section_position || item.position),
            activities: [],
        };
        const skill = inferredSkill(item, settings);
        // New deliveries persist an explicit activity_group_id. Legacy
        // snapshots are grouped by source block and skill so different
        // activities in one section cannot share a question carousel.
        const legacyActivityKey = settings.section_id
            ? `legacy:${sectionId}:${skill.toLowerCase()}:${item.source_lesson_block_id || item.id}`
            : (item.source_lesson_block_id ? `source:${item.source_lesson_block_id}` : 'activity:' + sectionId + ':' + skill.toLowerCase());
        const activityId = String(settings.activity_group_id || settings.listening_group_id || settings.reading_group_id || legacyActivityKey);
        const activity = section.activities.find((candidate) => candidate.id === activityId) || {
            id: activityId,
            title: String(settings.activity_group_title || settings.listening_title || settings.reading_title || skill.replaceAll('_', ' ')),
            skill,
            position: Number(settings.activity_position || item.position),
            items: [],
        };
        activity.items.push(item);
        if (!section.activities.includes(activity)) section.activities.push(activity);
        sections.set(sectionId, section);
    });

    return [...sections.values()].sort((a, b) => a.position - b.position).map((section) => ({
        ...section,
        activities: section.activities.sort((a, b) => a.position - b.position || (a.items[0]?.position ?? 0) - (b.items[0]?.position ?? 0)),
    }));
};
