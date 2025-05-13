/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  darkMode: 'class', // Mengaktifkan dark mode berdasarkan kelas
  theme: {
    extend: {
      fontFamily: {
        sans: ['Poppins', 'sans-serif'], // Menambahkan font Poppins
      },
      colors: {
        primary: {
          50: '#f0f9ff',
                    100: '#e0f2fe',
                    500: '#3b82f6',
                    600: '#2563eb',
                    700: '#1d4ed8',
        },
      },
    },
  },
  corePlugins: {
    preflight: true, // Pastikan ini true
  },
  important: true, // Gunakan ini jika CDN menggunakan important
}
