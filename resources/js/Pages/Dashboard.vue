<script setup xmlns="http://www.w3.org/1999/html" lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head  } from '@inertiajs/vue3';
import AddForm from "@/Components/forms/AddForm.vue";
import { ref } from 'vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps<{
    plugins: Array<any>
}>()

const truncateDescription = (description: string): string => {
    const words = description.trim().split(' ');
    return words.slice(0, 5).join(' ') + (words.length > 5 ? '...' : '');
}

const deleteProduct = (id: number) => {
    Inertia.delete(route('dashboard.destroy', { plugins: id }), {
        onFinish: () => {
            console.log('Plugin deleted');
        },
        onError: (errors) => {
            console.error('Error deleting plugin:', errors);
        }
    });
}

const editPlugin = (id: number) => {
    // Presmerovanie na editačnú stránku pre daný plugin
    Inertia.visit(route('dashboard.edit', { plugin: id }));
};


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <article class="container p-10 w-full">
                        <h2 class="ms-4 font-bold text-lg">Add new plugin!</h2>
                        <AddForm />
                    </article>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <article class="container p-10 w-full">
                        <h2 class="ms-4 font-bold text-lg">All plugins</h2>
                        <p class="text-sm ms-4 text-gray-800">For better coordinating</p>

                        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                            <div v-for="plugin in plugins" :key="plugin.id" class="group relative">
                                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none lg:h-80">
                                    <img :src="plugin.image" alt="" class="w-full h-full object-cover transition duration-500" />
                                </div>
                                <div class="mt-4 flex justify-between">
                                    <div>
                                        <h3 class="text-sm text-gray-700">
                                            <a>
                                                <span aria-hidden="true" class="absolute inset-0" />
                                                {{ plugin.name }}
                                            </a>
                                        </h3>
                                        <p class="text-sm text-gray-700">{{ truncateDescription(plugin.description) }}</p>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900">{{ plugin.category }} </p>
                                </div>
                                <PrimaryButton class="relative w-full justify-center mt-2" @click="deleteProduct(plugin.id)">Delete</PrimaryButton>
                          </div>
                        </div>

                    </article>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
