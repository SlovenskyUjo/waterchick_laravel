<template>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>
    <body :class="{ 'dark': theme === 'dark' }" class="dark:text-gray-200 dark:bg-slate-900">
    <Head title="Water_Chick" />
    <header
        class="fixed xl:block w-full py-4 lg:px-0 px-5 z-[999] duration-300"
        :class="{ 'navbar-blur': isNavbarScrolled }"
        ref="navbarRef"
    >
        <nav class="flex justify-between items-center max-w-6xl mx-auto px-2">
            <div class="flex gap-4 items-center">
                <div class="rounded-full size-10 text-xl grid place-items-center">
                    <a href="/">
                        <SmallLogo />
                    </a>
                </div>
            </div>
            <ul class="gap-10 md:flex text-xl hidden hover:*:text-primary absolute left-1/2 transform -translate-x-1/2 transition *:duration-200">
                <li v-for="link in links" :key="link.name">
                    <a :href="link.link"> {{ $t(link.name) }}</a>
                </li>
                <li @click="toggleTheme" class="theme-switch">
                    <i class="fa-solid fa-circle-half-stroke cursor-pointer"></i>
                </li>
            </ul>
            <div class="flex items-center gap-6">
                <a href="/login" v-if="!$page.props.auth.user">
                    <button class="btn btn-outline md:!flex !hidden">
                        <i class="fa-solid fa-lock"></i> Login
                    </button>
                </a>
                <a href="/profile" v-if="$page.props.auth.user && !$page.props.auth.user.is_admin">
                    <button class="btn btn-outline md:!flex !hidden">
                        <i class="fa-solid fa-user"></i> Profile
                    </button>
                </a>
                <a href="/dashboard" v-if="$page.props.auth.user && $page.props.auth.user.is_admin">
                    <button class="btn btn-outline md:!flex !hidden">
                        <i class="fa-solid fa-lock"></i> Dashboard
                    </button>
                </a>
                <span @click="toggleTheme" class="theme-switch md:hidden">
                    <i class="fa-solid fa-circle-half-stroke cursor-pointer"></i>
                </span>
                <span @click="MenuOpen" id="menubar" class="cursor-pointer md:hidden text-xl">
                    <i :class="[open ? 'fa-solid fa-xmark' : 'fa-solid fa-bars']"></i>
                </span>
                <div class="relative hidden md:inline">
                    <select
                        id="language"
                        required
                        class=" block px-3 py-2.5 w-full border-primary border-2 focus:border-primary focus:ring-primary dark:bg-slate-800 rounded-md shadow-sm"
                        v-model="selectedLanguage"
                    >
                        <option value="" disabled>Select language</option>
                        <option value="en" class="flex items-center">English</option>
                        <option value="cs" class="flex items-center">Čeština</option>
                    </select>
                </div>
            </div>
        </nav>
    </header>
    <span
        id="backdrop"
        class="fixed h-screen hidden bg-black/10 backdrop-blur-sm z-[997] inset-0 w-full"
    ></span>
    <ul
        id="mobile-nav"
        class="gap-10 text-xl md:hidden dark:bg-slate-800 text-white flex-center flex-col fixed w-full h-0 overflow-hidden bottom-0 duration-200 left-0 z-[998]"
        :class="{ 'h-screen bg-black/10 fixed inset-0 backdrop-blur-sm z-[997]': open, 'h-0': !open }"
    >
        <li v-for="link in links" :key="link.name">
            <a :href="link.link" @click="closeMenu">{{ $t(link.name) }}</a>
        </li>
        <a href="/login" v-if="!$page.props.auth.user">
            <button class="btn btn-outline">
                <i class="fa-solid fa-lock"></i> Login
            </button>
        </a>
        <a href="/dashboard" v-if="$page.props.auth.user && $page.props.auth.user.is_admin">
            <button class="btn btn-outline">
                <i class="fa-solid fa-lock"></i> Dashboard
            </button>
        </a>
        <a href="/profile" v-if="$page.props.auth.user && !$page.props.auth.user.is_admin">
            <button class="btn btn-outline">
                <i class="fa-solid fa-user"></i> Profile
            </button>
        </a>
        <div class="relative flex">
            <select
                id="category"
                required
                class="py-2.5 block w-full text-black border-2 border-primary focus:border-primary focus:ring-primary rounded-md shadow-sm dark:text-white dark:bg-slate-800 appearance-none"
                v-model="selectedLanguage"
            >
                <option value="en" :selected="locale === 'en'" class="flex items-center">English</option>
                <option value="cs" :selected="locale === 'cs'" class="flex items-center">Čeština</option>
                <!-- Add more categories with flags -->
            </select>
        </div>
    </ul>
    <!-- Home -->
    <section
        id="home"
        class="min-h-screen container grid place-items-center relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-heroLight before:bg-no-repeat before:bg-top before:size-full before:-z-[1] before:transform before:-translate-x-1/2 dark:before:bg-heroDark"
    >
        <Home />
    </section>
    <!-- Projects -->
    <section id="portfolio" class="container mx-auto py-10">
        <div class="text-center">
            <h3 class="text-3xl font-semibold text-gray-900 dark:text-gray-200 mb-2">{{ $t('plugins') }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-500 mb-7">{{ $t('pluginsDesc') }}</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div v-for="plugin in plugins" :key="plugin.id"
                     class="relative group border-4 dark:border-white rounded-md cursor-pointer overflow-hidden"
                     @click="redirectToUrl(plugin.url)"
                >
                    <!-- Container for image with dynamic sizing -->
                    <div class="relative w-full">
                        <img :src="plugin.image" alt="" class="w-full h-auto object-cover transition duration-500 transform group-hover:scale-110" />
                    </div>
                    <!-- Content below the image -->
                    <div class="p-4 bg-white h-full dark:bg-gray-800">
                        <h4 class="text-xl font-semibold text-gray-900 dark:text-gray-200 mb-2">{{ plugin.name }}</h4>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">{{ plugin.description }}</p>
                        <div class="flex justify-center items-center">
                            <span
                                class="text-sm font-medium px-3 py-1 rounded text-white"
                                :class="[
                                    plugin.category === 'Java' ? 'bg-orange-500' : '',
                                    plugin.category === 'Python' ? 'bg-blue-500' : '',
                                    plugin.category === 'Laravel' ? 'bg-red-500' : '',
                                    plugin.category === 'JavaScript' ? 'bg-yellow-500' : ''
                                ]"
                            >{{ plugin.category }}</span>
                        </div>
                        <div class="mt-4">
                            <span v-for="tag in plugin.tags" :key="tag.id" class="inline-block bg-gray-300 text-gray-900 rounded-full px-3 py-1 text-sm font-semibold mr-2 mb-2">
                                {{ tag.name }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="container mx-auto py-10 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
        <!-- Formulár -->
        <div class="w-full max-w-lg mx-auto">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-semibold text-gray-900 dark:text-gray-200 mb-4">{{ $t('contact') }}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-500">{{ $t('contactDesc') }}</p>
            </div>
            <form @submit.prevent="sendEmail" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $t('contactNameInput') }}</label>
                        <input v-model="formData.name" type="text" id="name" name="name" required class="block w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $t('contactEmailInput') }}</label>
                        <input v-model="formData.email" type="email" id="email" name="email" required class="block w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>
                </div>
                <div class="mb-6">
                    <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $t('contactMessageInput') }}</label>
                    <textarea v-model="formData.message" id="message" name="message" rows="4" required class="block w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                </div>
                <button type="submit" class="bg-primary text-white py-2 px-4 rounded-md shadow-sm hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">{{ $t('contactBtn') }}</button>
            </form>
        </div>
    </section>


    <!-- Footer -->
    <footer class="dark:bg-slate-700 bg-slate-100 text-center py-2 relative">
        <div>
            Copyright &copy; 2024 | Made by <a class="text-primary hover:underline" href="https://github.com/SlovenskyUjo" target="_blank">SlovenskyUjo</a> with ❤️
            <FooterLink />
        </div>
    </footer>
    </body>
    </html>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import {ref, onMounted, onUnmounted, watch} from 'vue';
import Home from '@/Components/Home.vue';
import SmallLogo from '@/Components/SmallLogo.vue';
import FooterLink from '@/Components/FooterLink.vue';
import { useI18n } from 'vue-i18n';
import emailjs from 'emailjs-com';


const open = ref(false);
const theme = ref("light");
const isNavbarScrolled = ref(false);
const navbarRef = ref<HTMLElement | null>(null);
const selectedLanguage = ref<string>("");

const formData = ref({
    name: '',
    email: '',
    message: ''
});

const sendEmail = (event: Event) => {
    event.preventDefault();

    const { name, email, message } = formData.value;

    console.log('Sending email with:', { name, email, message });

    emailjs.send('service_rvw7qcj', 'template_ylv29cx', {
        name: name,
        email: email,
        message: message
    }, 'oT4Vkny2712AwqY9R')
        .then((response) => {
            console.log('Email sent successfully:', response);
            alert('Your message has been sent!');

            // Vymazanie formulára
            formData.value = {
                name: '',
                email: '',
                message: ''
            };
        })
        .catch((error) => {
            console.error('Error sending email:', error);
            alert('There was an error sending your message.');
        });
};



const handleScroll = () => {
    const navbarHeight = navbarRef.value?.offsetHeight || 0;
    const scrollPosition = window.scrollY || window.pageYOffset;
    isNavbarScrolled.value = scrollPosition > navbarHeight;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);

    // Initialize theme from localStorage
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        theme.value = savedTheme;
        document.body.classList.toggle('dark', savedTheme === 'dark');
    }

    // Initialize locale from localStorage
    const savedLocale = localStorage.getItem('locale') || 'en';
    if (savedLocale) {
        locale.value = savedLocale;
        document.documentElement.setAttribute('lang', savedLocale);
        selectedLanguage.value = savedLocale;
    }
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});

const props = defineProps<{
    plugins: Array<any>,
    title: string,
}>();

const links = [
    { name: "home", link: "#home" },
    { name: "Portfolio", link: "#portfolio" },
    { name: "contactNav", link: "#contact" }
];

function MenuOpen() {
    open.value = !open.value;
}

function closeMenu() {
    open.value = false;
}

function toggleTheme() {
    theme.value = theme.value === "light" ? "dark" : "light";
    localStorage.setItem('theme', theme.value);
    document.body.classList.toggle("dark");
}

function redirectToUrl(url: string) {
    if (url) {
        window.open(url, '_blank');
    } else {
        window.location.reload();
    }
}

const { locale } = useI18n();

function changeLanguage() {
    console.log("Changing language to:", selectedLanguage.value);
    locale.value = selectedLanguage.value;
    localStorage.setItem('locale', selectedLanguage.value);
    document.documentElement.setAttribute('lang', selectedLanguage.value);
    closeMenu();
}

// Watch for changes in selectedLanguage to call changeLanguage
watch(selectedLanguage, changeLanguage);
</script>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css');

.navbar-blur {
    backdrop-filter: blur(5px);
    background-color: rgba(255, 255, 255, 0.8); /* Light blur effect */
}

.dark .navbar-blur {
    backdrop-filter: blur(5px);
    background-color: rgba(15, 23, 42, 0.8); /* Dark blur effect */
}

@keyframes draw {
    from {
        stroke-dasharray: 1000;
        stroke-dashoffset: 1000;
    }
    to {
        stroke-dasharray: 1000;
        stroke-dashoffset: 0;
    }
}

.stroke-animation {
    animation: draw 4s ease forwards; /* Zmeniť 4s na požadovaný čas animácie */
}


</style>
