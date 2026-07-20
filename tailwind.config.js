/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            "colors": {
                "on-error": "#ffffff",
                "on-error-container": "#93000a",
                "surface-tint": "#5f5e5e",
                "on-surface-variant": "#444748",
                "secondary": "#b32a03",
                "on-primary-fixed": "#1c1b1b",
                "on-primary-container": "#858383",
                "surface-variant": "#e2e2e2",
                "tertiary": "#000000",
                "border-subtle": "#E5E5E3",
                "on-secondary-fixed": "#3c0700",
                "tertiary-fixed": "#e6e2df",
                "error": "#ba1a1a",
                "tertiary-container": "#1c1b1a",
                "outline-variant": "#c4c7c7",
                "surface": "#f9f9f8",
                "surface-bright": "#f9f9f8",
                "tertiary-fixed-dim": "#cac6c4",
                "on-secondary-fixed-variant": "#8a1c00",
                "primary-container": "#1c1b1b",
                "inverse-on-surface": "#f1f1f0",
                "on-tertiary-fixed-variant": "#484645",
                "primary": "#000000",
                "on-secondary-container": "#5a0f00",
                "background": "#f9f9f8",
                "on-tertiary-fixed": "#1c1b1a",
                "inverse-primary": "#c8c6c5",
                "primary-fixed-dim": "#c8c6c5",
                "inverse-surface": "#2f3130",
                "text-secondary": "#666666",
                "on-primary": "#ffffff",
                "secondary-fixed-dim": "#ffb4a2",
                "surface-container-highest": "#e2e2e2",
                "on-tertiary": "#ffffff",
                "surface-container-lowest": "#ffffff",
                "on-primary-fixed-variant": "#474746",
                "surface-dim": "#dadad9",
                "primary-fixed": "#e5e2e1",
                "surface-container": "#eeeeed",
                "secondary-container": "#fe5e37",
                "outline": "#747878",
                "on-surface": "#1a1c1c",
                "surface-muted": "#F2F2F0",
                "on-secondary": "#ffffff",
                "surface-container-low": "#f3f4f3",
                "on-tertiary-container": "#868382",
                "secondary-fixed": "#ffdad2",
                "surface-container-high": "#e8e8e7",
                "error-container": "#ffdad6",
                "on-background": "#1a1c1c",
                "accent-coral": "#FF5F38"
            },
            "borderRadius": {
                "DEFAULT": "0.25rem",
                "lg": "0.5rem",
                "xl": "0.75rem",
                "full": "9999px"
            },
            "spacing": {
                "margin-mobile": "20px",
                "container-max": "1280px",
                "section-gap": "120px",
                "gutter": "24px",
                "margin-desktop": "64px"
            },
            "fontFamily": {
                "body-lg": ["Inter"],
                "label-sm": ["Inter"],
                "body-md": ["Inter"],
                "headline-md": ["Inter"],
                "display-lg-mobile": ["Inter"],
                "display-lg": ["Inter"]
            },
            "fontSize": {
                "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                "label-sm": ["13px", {"lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600"}],
                "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                "headline-md": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
                "display-lg-mobile": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                "display-lg": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "700"}]
            }
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/container-queries')
    ],
}
