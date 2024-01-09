<template>
    <MusicLayout>
        <template #title>
            Créer une musique
        </template>

        <template #action>
            <Link :href="route('tracks.index')">
                Retour
            </Link>
        </template>

        <template #content>
            form
        </template>
    </MusicLayout>
</template>

<script>
import MusicLayout from '@/Layouts/MusicLayout.vue'
export default {
    components: {
        MusicLayout,
    }
}
</script>