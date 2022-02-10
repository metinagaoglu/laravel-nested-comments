<template>
    <main class="container">

        <div class="row g-5">
            <form>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="username" class="form-control" placeholder="agaoglumetin" v-model="comment.username">
                </div>
                <div class="mb-3">
                    <label class="form-label">Enter your comment</label>
                    <textarea class="form-control" rows="3" v-model="comment.comment"></textarea>
                </div>
                <a v-on:click="submitComment">Submit your comment</a>
            </form>
        </div>

    </main>
</template>

<script>
export default {
    name: "CommentForm",
    props: [
        "parent_id",
        "level_of_nested"
    ],
    mounted() {

    },
    data() {
        return {
            comment: {}
        }
    },
    methods: {
        submitComment() {
            const commentObject = {
                parent_id: this.parent_id,
                level_of_nested: this.level_of_nested,
                username: this.comment.username,
                comment: this.comment.comment
            }
            console.log(commentObject);
            axios.post('/api/post/1/comment',commentObject)
                .then((res) => {
                    console.log(res);
                })
                .catch((err) => {
                    console.log(err);
                })

        }
    }
}
</script>
<style>
.blog-post{
    width: 100%;
}
</style>
