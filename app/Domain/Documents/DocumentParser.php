<?php

namespace App\Domain\Documents;

use PhpOffice\PhpPresentation\IOFactory as PresentationFactory;
use PhpOffice\PhpWord\IOFactory as WordFactory;
use RuntimeException;
use Smalot\PdfParser\Parser as PdfParser;

class DocumentParser
{
    public function parse(string $path, string $mime): array
    {
        return match ($mime) {
            'text/plain' => $this->text($path),'application/pdf' => $this->pdf($path),'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => $this->docx($path),'application/vnd.openxmlformats-officedocument.presentationml.presentation' => $this->pptx($path),default => throw new RuntimeException('Unsupported document format.')
        };
    }

    private function text(string $path): array
    {
        $text = file_get_contents($path);
        if ($text === false) {
            throw new RuntimeException('Unable to read document.');
        }

        return ['pages' => [['number' => 1, 'text' => $text]], 'parser' => 'plain-text'];
    }

    private function pdf(string $path): array
    {
        $pages = (new PdfParser)->parseFile($path)->getPages();

        return ['pages' => collect($pages)->values()->map(fn ($page, $i) => ['number' => $i + 1, 'text' => $page->getText()])->all(), 'parser' => 'smalot-pdfparser'];
    }

    private function docx(string $path): array
    {
        $doc = WordFactory::load($path);
        $parts = [];
        foreach ($doc->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                $parts[] = $this->wordText($element);
            }
        }

        return ['pages' => [['number' => 1, 'text' => implode("\n", array_filter($parts))]], 'parser' => 'phpoffice-phpword'];
    }

    private function wordText(object $element): string
    {
        if (method_exists($element, 'getRows')) {
            return collect($element->getRows())->map(fn ($row) => collect($row->getCells())->map(fn ($cell) => $this->wordText($cell))->implode(' | '))->implode("\n");
        }
        if (method_exists($element, 'getElements')) {
            return collect($element->getElements())->map(fn ($child) => $this->wordText($child))->filter()->implode("\n");
        }
        if (method_exists($element, 'getText')) {
            $text = $element->getText();

            return is_object($text) ? $this->wordText($text) : (string) $text;
        }if (method_exists($element, 'getElements')) {
            return collect($element->getElements())->map(fn ($child) => $this->wordText($child))->filter()->implode("\n");
        }

        return '';
    }

    private function pptx(string $path): array
    {
        $presentation = PresentationFactory::load($path);
        $pages = [];
        foreach ($presentation->getAllSlides() as $i => $slide) {
            $text = [];
            foreach ($slide->getShapeCollection() as $shape) {
                if (method_exists($shape, 'getText')) {
                    $text[] = $shape->getText();
                }
            }$pages[] = ['number' => $i + 1, 'text' => implode("\n", $text)];
        }

        return ['pages' => $pages, 'parser' => 'phpoffice-phppresentation'];
    }
}
