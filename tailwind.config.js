/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'primary-red': '#E31837',
        'dark-red': '#A11126',
        'accent-blue': '#0047BB',
        'bg-white': '#FFFFFF',
        'off-white': '#FAFAFA',
        'text-dark': '#0F172A',
        'text-muted': '#64748B',
        'border-subtle': '#F1F5F9',
      },
      fontFamily: {
        sans: ['DM Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        serif: ['DM Serif Display', 'ui-serif', 'Georgia', 'serif'],
      },
      boxShadow: {
        'premium': '0 10px 15px -3px rgba(0, 0, 0, 0.04), 0 4px 6px -2px rgba(0, 0, 0, 0.02)',
        'soft-red': '0 20px 25px -5px rgba(227, 24, 55, 0.1), 0 10px 10px -5px rgba(227, 24, 55, 0.04)',
      }
    },
  },
  plugins: [],
}
