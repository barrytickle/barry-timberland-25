export default {
  content: ["./theme/views/**/*.twig", "./theme/blocks/**/*.twig"],
  theme: {
    extend: {
      colors: {
        dark: {
          950: "#0e1012",
          900: "#19181F",
          800: "#1E1B24",
          700: "#23202A",
          600: "#333139",
          500: "#4f4d55",
          400: "#C2C6DD",
          300: "#C2C6DD",
          200: "#d3d2d4",
          100: "#e9e9ea",
        },
      },

      width: {
        18: "4.5rem",
      },

      height: {
        18: "4.5rem",
      },

      inset: {
        "-25": "-6.25rem",
      },

      padding: {
        18: "4.5rem",
        "11/12": "91.666667%",
        "3/2": "150%",
      },

      transitionDuration: {
        250: "250ms",
      },
    },
  },
  plugins: [require("@tailwindcss/typography")],
};
