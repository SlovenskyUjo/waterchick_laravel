<template>
    <form @submit.prevent="submit" class="max-w-lg mx-auto">
        <!-- Name Input -->
        <div class="container m-3">
            <InputLabel for="name" value="Name" />
            <TextInput
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                required
                autofocus
                autocomplete="name"
            />

            <InputError class="mt-2" :message="form.errors.name" />
        </div>

        <!-- Description Textarea -->
        <div class="container m-3">
            <InputLabel for="description" value="Description" />
            <textarea
                id="description"
                type="text"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                rows="5"
                v-model="form.description"
                required
                autofocus
                autocomplete="description"
            ></textarea>

            <InputError class="mt-2" :message="form.errors.description" />
        </div>

        <!-- Category Select -->
        <div class="container m-3">
            <InputLabel for="category" value="Category" />
            <select
                id="category"
                v-model="form.category"
                required
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            >
                <option value="" disabled>Select category</option>
                <option value="Java">Java</option>
                <option value="Laravel">Laravel</option>
                <option value="Python">Python</option>
                <option value="JavaScript">JavaScript</option>
                <!-- Add more categories -->
            </select>
            <InputError class="mt-2" :message="form.errors.category" />
        </div>

        <!-- Tag Input -->
        <div class="container m-3">
            <InputLabel for="tags" value="Tags" />
            <input
                id="tags"
                type="text"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                v-model="tagString"
                placeholder="Enter tags separated by commas"
            />

            <InputError class="mt-2" :message="form.errors.tags" />
        </div>


        <!-- URL Input -->
        <div class="container m-3">
            <InputLabel for="url" value="URL" />
            <TextInput
                id="url"
                type="text"
                class="mt-1 block w-full"
                v-model="form.url"
                required
                autocomplete="url"
            />

            <InputError class="mt-2" :message="form.errors.url" />
        </div>


        <!-- Image Upload -->
        <div class="container m-3">
            <InputLabel for="image" value="Image" />
            <div class="mt-1 flex items-center">
                <label for="image" class="cursor-pointer bg-white rounded-md border border-gray-300 py-2 px-4 flex items-center justify-center w-full">
                    <span class="text-primary">Select a file</span>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        @change="handleFileUpload"
                        required
                        class="hidden"
                    />
                </label>
                <span class="ml-2" v-if="form.image">{{ form.image.name }}</span>
            </div>

            <InputError class="mt-2" :message="form.errors.image" />
        </div>

        <!-- Submit Button -->
        <div class="container m-3">
            <PrimaryButton
                type="submit"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                class="w-full justify-center"
            >
                Add new plugin!
            </PrimaryButton>
        </div>
    </form>
</template>

<script setup xmlns="http://www.w3.org/1999/html">
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { useForm } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import {ref} from "vue";

const form = useForm({
    name: '',
    description: '',
    image: '',
    category: '',
    tags: [],
    url: '',
});

const tagString = ref('');

function submit() {
    // Convert tagString to array and assign to form.tags
    form.tags = tagString.value.split(',').map(tag => tag.trim());

    form.post('/dashboard', {
        onSuccess: () => {
            form.reset();
            tagString.value = '';
        },
    });
}

// Funkcia na získanie názvu súboru z eventu
function handleFileUpload(event) {
    const file = event.target.files[0];
    form.image = file;
}

</script>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css');
</style>
