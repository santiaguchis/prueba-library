import colors from 'vuetify/lib/util/colors';

const vuetifyConfig = {
    theme: {
        options: {
            customProperties: true,
        },
        dark: false,
        themes: {
            light: {
                background: '#FFFFFF',
                primary: colors.grey.darken4,
                secondary: colors.blue.base,
                info: colors.lightBlue.base,
                accent: colors.green.base,
                error: colors.red.base,
            },
        },
    }
}
export default vuetifyConfig
