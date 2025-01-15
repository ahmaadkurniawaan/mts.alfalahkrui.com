import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/page-builder/filament-page-builder.js",
                "resources/js/page-builder/filament-page-builder.css",
            ],
            refresh: true,
        }),
    ],
    
    build: {
        outDir: "public/assets",
        rollupOptions: {
            output: {
                entryFileNames: "[name].min.js",
                chunkFileNames: "[name].min.js",
                assetFileNames: "[name][extname]",
                manualChunks: undefined,
            },
        },
        minify: "terser",
    },
});
