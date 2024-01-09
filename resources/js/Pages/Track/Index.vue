<template>
    <MusicLayout>
        <template #title>
            <div>
                Musique
            </div>
        </template>

        <template #action>
            <Link :href="route('tracks.create')">
                creer une musique
            </Link>
        </template>
        <template #content>
            <div>
                <ul>
                    <li v-for="track in tracks" :key="track.uuid" :class="track.id % 2 ? 'text-red-500' : 'text-green-500'">
                        Artist : {{ track.artist }} / Titre : {{ track.title }}
                    </li>
                </ul>
            </div>
        </template>
    </MusicLayout>
</template>

<script>
import MusicLayout from '@/Layouts/MusicLayout.vue'

export default {
    components: {
        MusicLayout,
    },
    props: {
        tracks: Array
    }
}
</script>