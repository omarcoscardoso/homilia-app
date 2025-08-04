<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\LaravelMarkdown\MarkdownRenderer;

class GeminiHomiliaController extends Controller
{
     public function exportPdf(Request $request, MarkdownRenderer $markdownRenderer)
    {
        $markdownContent = $request->input('sermon_content');

        if (!$markdownContent) {
            return redirect()->back()->with('error', 'Não há conteúdo de sermão para exportar.');
        }

        // Replicar a lógica de limpeza do Markdown aqui para garantir consistência
        $lines = explode("\n", $markdownContent);
        $cleanedLines = [];
        $foundFirstUsefulLine = false;

        foreach ($lines as $line) {
            $trimmedLine = trim($line);
            if (!$foundFirstUsefulLine && (empty($trimmedLine) 
                || str_starts_with($trimmedLine, '*gerado em:') 
                || str_starts_with($trimmedLine, 'data:') 
                || str_starts_with($trimmedLine, '```'))) {
                continue;
            }
            $foundFirstUsefulLine = true;
            $cleanedLines[] = $line;
        }

        if (!empty($cleanedLines) && str_ends_with(trim(end($cleanedLines)), '```')) {
             array_pop($cleanedLines);
        }

        while(!empty($cleanedLines) && trim($cleanedLines[0]) === '') {
            array_shift($cleanedLines);
        }

        $finalMarkdown = implode("\n", $cleanedLines);

        // Converte o Markdown limpo para HTML
        $htmlContent = $markdownRenderer->toHtml($finalMarkdown);

        // Estrutura HTML completa para o PDF, incluindo o CSS inline
        $fullHtmlForPdf = "<!DOCTYPE html>
        <html>
        <head>
            <meta charset='utf-8'>
            <title>Esboço do Sermão</title>
            <style>
            body {
                font-family: Arial, sans-serif;
                margin: 10mm;
            }
            h1 {
                @apply text-2xl md:text-2xl font-extrabold mb-0 text-gray-900 dark:text-gray-100;
                line-height: 1.25; /* Ajusta a altura da linha para melhor leitura */
            }
            h2 {
                @apply text-2xl md:text-3xl font-bold mb-4 mt-8 text-blue-700 dark:text-blue-300;
                border-bottom: 2px solid theme('colors.blue.200'); /* Adiciona uma linha sutil */
                @apply dark:border-blue-700 pb-2; /* Estilo da linha no modo escuro e padding */
            }
            h3 {
                @apply text-xl md:text-2xl font-semibold mb-3 mt-6 text-blue-600 dark:text-blue-400;
                line-height: 1.3;
            }
            p {
                @apply mb-4 leading-relaxed text-gray-800 dark:text-gray-200;
            }
            ul {
                @apply list-disc pl-6 mb-4 space-y-2; /* Adiciona espaçamento entre itens da lista */
            }
            li {
                @apply text-gray-700 dark:text-gray-300;
            }
            h2 + p, h3 + p, h2 + ul, h3 + ul {
                page-break-before: auto !important;
            }
            .no-break {
                page-break-inside: avoid !important;
            }
            strong {
                @apply font-bold text-gray-900 dark:text-gray-100;
            }
            em {
                @apply text-2xl text-gray-600 dark:text-gray-400;
            }
            blockquote {
                @apply border-l-4 border-blue-400 dark:border-blue-600 pl-4 py-1 my-4 italic text-gray-700 dark:text-gray-300;
            }
            code {
                @apply bg-gray-200 dark:bg-gray-700 text-purple-700 dark:text-purple-300 px-1 py-0.5 rounded text-sm;
            }
            a {
                @apply text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-200 underline;
            }
            </style>
        </head>
        <body>
            " . $htmlContent . "
        </body>
        </html>";

        // dd($fullHtmlForPdf);
        $pdf = Pdf::loadHtml($fullHtmlForPdf);

        $pdf->setPaper('A4', 'portrait');

        $filename = 'esboco_homilIA_' . now()->format('Ymd_His') . '.pdf';

        // Retorna o PDF para download
        return $pdf->download($filename);
        // return $pdf->stream($filename);
    }
}