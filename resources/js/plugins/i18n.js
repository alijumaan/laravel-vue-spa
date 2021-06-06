import { createI18n } from 'vue-i18n/index'

// 1. Ready translated locale messages
// The structure of the locale message is the hierarchical object structure with each locale as the top property
const messages = {
    en: {
        message: {
            hello: 'hello world'
        }
    },
    sa: {
        message: {
            hello: 'مرحبا بالعالم'
        }
    }
}

const i18n = createI18n({
    // something vue-i18n options here ...
    locale: 'sa',
    fallbackLocale: 'en',
    messages, // set locale messages
    // If you need to specify other options, you can set other options
    // ...
})

export default i18n
