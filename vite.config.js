import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import dotenv from "dotenv";
dotenv.config();

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/sass/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        host: process.env.VITE_HOST,
    },
});
