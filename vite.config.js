import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import fs from 'fs';
import path from 'path';

const valetCertPath = path.resolve(
    process.env.HOME,
    '.config/valet/Certificates/portfolio.test'
)

export default defineConfig({
    server: {
        host: 'portfolio.test',
        https: {
            key: fs.readFileSync(`${valetCertPath}.key`),
            cert: fs.readFileSync(`${valetCertPath}.crt`),
        },
        hmr: {
            host: 'portfolio.test',
        },
    },
    plugins: [
        laravel({
            input: ['resources/scss/app.scss', 'resources/js/app.tsx'],
            refresh: true,
        }),
	react(),
    ],
});
