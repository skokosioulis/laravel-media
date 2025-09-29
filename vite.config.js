import { defineConfig } from 'vite';

export default defineConfig({
    build: {
        outDir: 'dist',
        lib: {
            entry: 'resources/assets/js/laravel-media.js',
            name: 'LaravelMedia',
            fileName: 'media',
            formats: ['umd'] // Only generate UMD format
        },
        rollupOptions: {
            external: [], // Add external dependencies if needed
            output: {
                globals: {}
            }
        }
    }
});
