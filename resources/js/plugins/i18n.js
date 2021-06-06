import { createI18n } from 'vue-i18n/index'
import ar from '../../lang/ar/ar.json'
import en from '../../lang/en/en.json'

export const i18n = createI18n({
    locale: localStorage.getItem('locale') || 'ar',
    fallbackLocale: 'en',
    messages: {
        ar, en
    },
})
