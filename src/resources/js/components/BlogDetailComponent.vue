<template>
    <main class="container">

        <div class="row g-5">
            <div class="col-md-8">
                <h3 class="pb-4 mb-4 fst-italic border-bottom">
                    Metin Ağaoğlu
                </h3>

                <article class="blog-post">
                    <h2 class="blog-post-title">{{ title }}</h2>
                    <p class="blog-post-meta">January 1, 2021 by <a href="#">Mark</a></p>

                    <p>{{ content }}</p>
                    <hr>
                </article>

                <div v-if="this.isCommentLoaded">
                    <comment-tree
                        v-for="reply in this.commentsTree"
                        :item="reply"
                    ></comment-tree>
                </div>
                <br>

                <nav class="blog-pagination" aria-label="Pagination">
                    <a class="btn btn-outline-primary" href="#">Older</a>
                    <a class="btn btn-outline-secondary disabled">Newer</a>
                </nav>

            </div>

            <div class="col-md-4">
                <div class="position-sticky" style="top: 2rem;">
                    <div class="p-4 mb-3 bg-light rounded">
                        <h4 class="fst-italic">About</h4>
                        <p class="mb-0">Customize this section to tell your visitors a little bit about your publication, writers, content, or something else entirely. Totally up to you.</p>
                    </div>

                    <div class="p-4">
                        <h4 class="fst-italic">Archives</h4>
                        <ol class="list-unstyled mb-0">
                            <li><a href="#">March 2021</a></li>
                            <li><a href="#">February 2021</a></li>
                            <li><a href="#">January 2021</a></li>
                            <li><a href="#">December 2020</a></li>
                            <li><a href="#">November 2020</a></li>
                            <li><a href="#">October 2020</a></li>
                            <li><a href="#">September 2020</a></li>
                            <li><a href="#">August 2020</a></li>
                            <li><a href="#">July 2020</a></li>
                            <li><a href="#">June 2020</a></li>
                            <li><a href="#">May 2020</a></li>
                            <li><a href="#">April 2020</a></li>
                        </ol>
                    </div>

                    <div class="p-4">
                        <h4 class="fst-italic">Elsewhere</h4>
                        <ol class="list-unstyled">
                            <li><a href="#">GitHub</a></li>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Facebook</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </main>
</template>

<script>
    export default {
        name: "BlogDetail",
        mounted() {
            this.fetchBlog();
            this.fetchCommentsOfPost();
            this.$root.$on('newComment', () => {
                this.fetchCommentsOfPost();
            })
        },
        data() {
            return {
                title: null,
                content: null,
                isCommentLoaded: false,
                commentsTree: null,
            }
        },
        methods: {
            fetchBlog() {
                axios
                    .get("/api/post/1",)
                    .then((res) => {
                        this.title = res.data.title;
                        this.content = res.data.content;
                    })
                    .catch((err) => {
                        console.log(err);
                    })
            },
            fetchCommentsOfPost() {
                axios
                    .get("/api/post/1/comment",)
                    .then((res) => {
                        this.commentsTree = res.data;
                        this.isCommentLoaded = true;
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
