module.exports = {
    darkMode: "class",
    purge: {
        content: [
            "./src/**/*.php",
            "./resources/css/**/*.php",
        ],
    },
    content: ["./src/**/*.php", "./resources/**/*.php"],
    theme: {
        extend: {},
    },
    plugins: [],
};
