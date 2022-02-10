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
            <div v-if="replyStatus">
                <comment-form
                    :level_of_nested="item.level_of_nested+1"
                    :parent_id="item.id"
                ></comment-form>
            </div>
            <a @click="replyComment">Reply this</a>
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
            comment: {},
            replyStatus: false,
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
        this.$root.$on('newComment', () => {
            this.replyStatus = false
        })
    },
    methods: {
        handleBorn() {
            this.nodeCount++;
            this.$emit('born');
        },
        replyComment() {
            this.replyStatus = true
        }
    },
};
</script>
