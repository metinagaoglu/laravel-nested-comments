<template>
    <main class="container">

        <div class="row g-5 commentCard">
            <form>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="username" class="form-control" placeholder="agaoglumetin" v-model="comment.username">
                </div>
                <div class="mb-3">
                    <label class="form-label">Enter your comment</label>
                    <textarea class="form-control" rows="3" v-model="comment.comment"></textarea>
                </div>
                <a class="btn btn-primary commentButton" v-on:click="submitComment">Submit your comment</a>
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
                username: this.comment.username,
                comment: this.comment.comment
            }
            if (this.parent_id === 0) {
                delete commentObject.parent_id;
            }
            axios.post('/api/post/1/comment',commentObject)
                .then((res) => {
                    this.$root.$emit('newComment');
                })
                .catch((err) => {
                    //Handle exception
                    console.log(err);
                })

        }
    }
}
</script>
<style>
.commentButton {
    margin-bottom: 10px;
}
.commentCard {
    margin-bottom: 10px;
    margin-top: 10px;
}
</style>
