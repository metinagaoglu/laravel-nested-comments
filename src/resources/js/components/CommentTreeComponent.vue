<template>
    <div>
        <div class="card" :style=offset>
            <div class="card-header">
                {{ item.created_at }}
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>{{ item.comment }}</p>
                    <footer class="blockquote-footer"><cite title="Source Title">{{ item.username }}</cite></footer>
                </blockquote>
            </div>
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
            comment: {}
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
                'margin-bottom': '5px'
                //'background-color': COLORS[this.depth % COLORS.length],
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
        }
    },
};
</script>
