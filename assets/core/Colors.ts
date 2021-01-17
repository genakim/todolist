type colorVariations = {
    [key: string]: string
}
export default class Color {
    private static colors: colorVariations = {
        YELLOW: '#ffeb3b',
        GREEN: '#00e676',
        BLUE: '#00b8d4',
        GREY: '#e0e0e0',
        RED: '#ff5722',
        DEFAULT: '#ffffff'
    }

    static get(color: string): string
    {
        let variation = Color.colors[color]
        if (!variation) {
            variation = Color.colors.DEFAULT
        }
        return variation
    }

    static all(): colorVariations
    {
        return Color.colors
    }
}