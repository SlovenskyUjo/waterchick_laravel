import { createI18n } from "vue-i18n";
import en from './locales/en';
import cs from './locales/cs';

const messages = {
    en,
    cs,
};

const locale = document.documentElement.lang || 'en';

const i18n = createI18n({
   legacy: false,
    locale: locale,
    fallbackLocale: 'en',
    messages,
});

export default i18n;
