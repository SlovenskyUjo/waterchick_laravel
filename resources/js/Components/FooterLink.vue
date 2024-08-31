<template>
    <ul class="flex-center gap-5 py-4 text-sm">
        <li v-for="link in links">
            <a :href="link.link">{{ $t(link.name) }}</a>
        </li>
    </ul>
</template>

<script setup>
const links = [
    {name: "home", link: "#home"},
    {name: "Portfolio", link: "#portfolio"},
    {name: "contactNav", link: "#contact"},
]
</script>
