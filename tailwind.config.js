/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./assets/**/*.js', './templates/**/*.html.twig'],
  theme: {
    extend: {
      colors: {
        blue: {
          50: '#ccf9f9',
          150: '#0ac7b8',
        },
        gold: {
          50: '#efe5d1',
          150: '#c79a3c',
          250: '#785A28',
        },
        darkBlue: {
          50: '#010a13',
          150: '#0D1626',
        },
        gradient: {
          150: '#15395E',
          250: '#AA2A16',
        },
      },
      fontFamily: {
        beaufort: ['beaufort'],
      },
      gridTemplateColumns: {
        match: '1fr auto 1fr',
      },
      zIndex: {
        999: '999',
        9999: '9999',
      },
    },
  },
  plugins: [],
}
