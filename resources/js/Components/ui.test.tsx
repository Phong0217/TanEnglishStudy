import { render, screen } from '@testing-library/react';
import { describe, expect, it } from 'vitest';
import Button from './Button';
import { Badge, EmptyState } from './ui';

describe('UI primitives', () => {
    it('renders status badges accessibly', () => {
        render(<Badge value="PUBLISHED" />);
        expect(screen.getByText('Đã xuất bản')).toBeInTheDocument();
    });

    it('renders empty state action when provided', () => {
        render(<EmptyState title="No classes yet" description="Create your first class to get started." />);
        expect(screen.getByText('Create your first class to get started.')).toBeInTheDocument();
    });

    it('keeps a stable disabled button while loading', () => {
        render(<Button variant="primary" loading loadingLabel="Saving…">Save</Button>);
        expect(screen.getByRole('button')).toBeDisabled();
        expect(screen.getByText('Saving…')).toBeVisible();
    });
});
