import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { VitePWA } from 'vite-plugin-pwa';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        VitePWA({
            registerType: 'autoUpdate',
            // Adicionando os ícones do manifesto para o precache do service worker
            includeAssets: ['favicon.ico', 'apple-touch-icon.png', 'masked-icon.svg', 'images/icons/*.png'],
            // O nome do manifesto do PWA não pode ser 'manifest.json' para não conflitar com o manifesto de build do Vite.
            // O padrão 'manifest.webmanifest' é uma excelente escolha. O plugin injetará a tag <link> correta automaticamente.
            // Adiciona a base de build para garantir que o Service Worker encontre os assets corretamente no ambiente Laravel.
            buildBase: '/build/',
            manifestFilename: 'manifest.webmanifest',
            workbox: {
                // Garante que todas as rotas não encontradas no cache retornem para a raiz,
                // o que é ótimo para o funcionamento offline de uma Single Page Application (SPA).
                navigateFallback: '/',
            },
            manifest: {
                name: 'HomilIA App',
                short_name: 'Homilia',
                description: 'Um aplicativo que te ajuda a gerar esboço de sermão.',
                lang: 'pt-BR',
                start_url: '/',
                scope: '/',
                display: 'standalone',
                background_color: '#ffffff',
                theme_color: '#1F2937',
                icons: [
                    {
                        src: '/images/icons/icon-72x72.png',
                        sizes: '72x72',
                        type: 'image/png',
                        purpose: 'any'
                    },
                    {
                        src: '/images/icons/icon-96x96.png',
                        sizes: '96x96',
                        type: 'image/png',
                        purpose: 'any'
                    },
                    {
                        src: '/images/icons/icon-128x128.png',
                        sizes: '128x128',
                        type: 'image/png',
                        purpose: 'any'
                    },
                    {
                        src: '/images/icons/icon-192x192.png',
                        sizes: '192x192',
                        type: 'image/png',
                        purpose: 'any'
                    },
                    {
                        src: '/images/icons/icon-512x512.png',
                        sizes: '512x512',
                        type: 'image/png',
                        purpose: 'maskable any'
                    }
                ]
            }
        })
    ],
});
