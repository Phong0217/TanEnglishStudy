import { describe, expect, it } from 'vitest';
import { buildLessonHierarchy, isQuestion, LessonItem, normalizeLessonItems } from './lessonHierarchy';

const item = (id: number, type: string, settings: Record<string, unknown>): LessonItem => ({
    id,
    item_type: type,
    content_snapshot_json: { prompt: 'Question ' + id },
    settings_snapshot_json: settings,
    points: '1',
    position: id,
});

describe('lesson activity hierarchy', () => {
    it('normalizes partial persisted snapshots without crashing the player', () => {
        const [normalized] = normalizeLessonItems([{ id: 7, item_type: 'multiple_choice', content_snapshot_json: null, settings_snapshot_json: null }]);

        expect(normalized.id).toBe(7);
        expect(normalized.content_snapshot_json).toEqual({});
        expect(normalized.settings_snapshot_json).toEqual({});
        expect(normalized.position).toBe(1);
    });

    it('keeps listening and writing questions in separate activities within one part', () => {
        const [part] = buildLessonHierarchy([
            item(1, 'multiple_choice', { section_id: 'part-1', section_title: 'Part I', activity_group_id: 'listen-1', activity_group_type: 'LISTENING', activity_group_title: 'Listening' }),
            item(2, 'multiple_choice', { section_id: 'part-1', section_title: 'Part I', activity_group_id: 'listen-1', activity_group_type: 'LISTENING', activity_group_title: 'Listening' }),
            item(3, 'open_response', { section_id: 'part-1', section_title: 'Part I', activity_group_id: 'write-1', activity_group_type: 'WRITING', activity_group_title: 'Writing' }),
        ]);

        expect(part.activities).toHaveLength(2);
        expect(part.activities[0].items.map((candidate) => candidate.id)).toEqual([1, 2]);
        expect(part.activities[1].items.map((candidate) => candidate.id)).toEqual([3]);
        expect(part.activities[0].items.filter(isQuestion)).toHaveLength(2);
        expect(part.activities[1].items.filter(isQuestion)).toHaveLength(1);
    });

    it('keeps reading questions isolated from another part', () => {
        const sections = buildLessonHierarchy([
            item(1, 'multiple_choice', { section_id: 'part-1', section_title: 'Part I', activity_group_id: 'listen-1', activity_group_type: 'LISTENING' }),
            item(2, 'multiple_choice', { section_id: 'part-2', section_title: 'Part II', activity_group_id: 'read-1', activity_group_type: 'READING' }),
            item(3, 'multiple_choice', { section_id: 'part-2', section_title: 'Part II', activity_group_id: 'read-1', activity_group_type: 'READING' }),
        ]);

        expect(sections).toHaveLength(2);
        expect(sections[0].activities[0].items.map((candidate) => candidate.id)).toEqual([1]);
        expect(sections[1].activities[0].items.map((candidate) => candidate.id)).toEqual([2, 3]);
    });

    it('uses the source block as a safe fallback for older snapshots', () => {
        const [part] = buildLessonHierarchy([
            { ...item(1, 'multiple_choice', { section_id: 'part-1', activity_group_type: 'LISTENING' }), source_lesson_block_id: 40 },
            { ...item(2, 'multiple_choice', { section_id: 'part-1', activity_group_type: 'LISTENING' }), source_lesson_block_id: 40 },
            { ...item(3, 'multiple_choice', { section_id: 'part-1', activity_group_type: 'LISTENING' }), source_lesson_block_id: 41 },
        ]);

        expect(part.activities).toHaveLength(2);
        expect(part.activities[0].items.map((candidate) => candidate.id)).toEqual([1, 2]);
        expect(part.activities[1].items.map((candidate) => candidate.id)).toEqual([3]);
    });

    it('does not merge legacy listening and writing items sharing a section source', () => {
        const [part] = buildLessonHierarchy([
            { ...item(1, 'multiple_choice', { section_id: 'part-1', section_title: 'Part I', activity_group_type: 'LISTENING' }), source_lesson_block_id: 50 },
            { ...item(2, 'open_response', { section_id: 'part-1', section_title: 'Part I', activity_group_type: 'WRITING' }), source_lesson_block_id: 50 },
        ]);

        expect(part.activities).toHaveLength(2);
        expect(part.activities[0].skill).toBe('LISTENING');
        expect(part.activities[1].skill).toBe('WRITING');
    });
});
