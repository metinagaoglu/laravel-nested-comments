<template>
    <div>
        <div style="border: 1px solid black; padding: 5px;" :style="offset">
            {{ item.comment }}
        </div>

        <template v-if="item.replies">
            <comment-tree
                v-for="reply in item.replies"
                :key="reply.id"
                :item="reply"
                :depth="reply.level_of_nested"
                @born="handleBorn()"/>
        </template>
    </div>
</template>

<script>
const COLORS = [
    'white',
    'lightgray',
    'lightblue', // Nested comments are up to 3 layers only
];

export default {
    name: 'commentTree',
    props: {
        item: {type: Object, required: true},
        depth: {type: Number, default: 0},
    },
    data() {
        return {
            nodeCount: 0,
        };
    },
    computed: {
        direct() {
            if (Array.isArray(this.item.replies)) {
                return this.item.replies.length;
            }

            return 0;
        },

        offset() {
            return {
                'margin-left': (this.depth * 20) + 'px',
                'background-color': COLORS[this.depth % COLORS.length],
            };
        },
    },
    mounted() {
        this.$emit('born');
    },
    methods: {
        handleBorn() {
            this.nodeCount++;
            this.$emit('born');
        },
    },
};
</script>
