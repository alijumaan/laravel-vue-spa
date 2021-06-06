import { createI18n } from 'vue-i18n/index'
import ar from '../../lang/ar/ar.json'
import en from '../../lang/en/en.json'

export const i18n = createI18n({
    locale: process.env.VUP_APP_I18N_LOCALE || 'ar',
    fallbackLocale: process.env.VUE_APP_I18N_FALLBACK_LOCALE || 'en',
    messages: {
        ar, en
    },
})
