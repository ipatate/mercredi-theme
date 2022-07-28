module.exports = {
  content: ['./**/*.{php,twig,html}', './assets/*.{js,jsx,ts,tsx,vue}'],
  theme: {
    fontFamily: {
      sans: ['Roboto', 'helvetica', 'arial', 'sans-serif'],
      display: ['Roboto', 'helvetica', 'arial', 'sans-serif'],
      sherif: ['Norican', 'helvetica', 'arial', 'sans-serif'],
      body: ['Roboto', 'helvetica', 'arial', 'sans-serif'],
    },
    extend: {
      backgroundImage: (theme) => ({
        'down-nav': "url('/assets/media/down.svg')",
        'down-nav-mobile': "url('/assets/media/arrow-left.svg')",
        logo: "url('/assets/media/logo_mercredi.png')",
        'logo-white': "url('/assets/media/logo_mercredi_blanc.png')",
        'logo-white-sm': "url('/assets/media/logo_mercredi_blanc-sm.png')",
        instagram: "url('/assets/media/instagram.svg')",
        'instagram-accent': "url('/assets/media/instagram-accent.svg')",
        facebook: "url('/assets/media/facebook.svg')",
        play: "url('/assets/media/play.svg')",
        pause: "url('/assets/media/pause.svg')",
        previous: "url('/assets/media/previous.svg')",
        next: "url('/assets/media/next.svg')",
        cart:
          'url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiBhcmlhLWhpZGRlbj0idHJ1ZSIgcm9sZT0iaW1nIiBjbGFzcz0iaWNvbmlmeSBpY29uaWZ5LS1pb24iIHdpZHRoPSIxZW0iIGhlaWdodD0iMWVtIiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJ4TWlkWU1pZCBtZWV0IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiI+PHBhdGggZmlsbD0iIzc0NzI4MCIgZD0iTTQ1NC42NSAxNjkuNEEzMS44MiAzMS44MiAwIDAgMCA0MzIgMTYwaC02NHYtMTZhMTEyIDExMiAwIDAgMC0yMjQgMHYxNkg4MGEzMiAzMiAwIDAgMC0zMiAzMnYyMTZjMCAzOSAzMyA3MiA3MiA3MmgyNzJhNzIuMjIgNzIuMjIgMCAwIDAgNTAuNDgtMjAuNTVhNjkuNDggNjkuNDggMCAwIDAgMjEuNTItNTAuMlYxOTJhMzEuNzUgMzEuNzUgMCAwIDAtOS4zNS0yMi42Wk0xNzYgMTQ0YTgwIDgwIDAgMCAxIDE2MCAwdjE2SDE3NlptMTkyIDk2YTExMiAxMTIgMCAwIDEtMjI0IDB2LTE2YTE2IDE2IDAgMCAxIDMyIDB2MTZhODAgODAgMCAwIDAgMTYwIDB2LTE2YTE2IDE2IDAgMCAxIDMyIDBaIj48L3BhdGg+PC9zdmc+)',
      }),
      colors: {
        // accent: '#450B40',
        accent: '#b08067',
      },
      typography: (theme) => ({
        DEFAULT: {
          css: {
            color: theme('colors.gray.800'),
          },
        },
      }),
    },
  },
  variants: {
    extend: {},
  },
  plugins: [require('@tailwindcss/forms')],
}
