<template>
    <div class="container">
        <div class="row pt-4 px-3" v-for="signature in signatures" :key="signature.id">
            <div class="col-sm-1 col-2 px-sm-3 px-0">
                <img class="img-fluid p-0 img-thumbnail rounded-circle" :src="signature.avatar" :alt="signature.name" />
            </div>
            <div class="col pb-sm-4 pb-2" style="border-bottom: 1px solid gainsboro;">
                <div class="d-flex flex-sm-row flex-column flex-wrap justify-content-between">
                    <strong>{{ signature.name }}</strong>
                    <p class="text-muted">{{ signature.date }}</p>
                </div>
                <p class="mt-1">{{ signature.body }}</p>
                <span>
                    <a class="btn btn-sm p-0 font-weight-bold" id="comments" @click="report(signature.id)" role="button"><i class="bi bi-flag-fill"></i> Report</a>
                </span>
            </div>
        </div>
        <nav>
            <paginate
                :page-count="pageCount"
                :click-handler="fetch"
                :prev-text="'&laquo;'"
                :next-text="'&raquo;'"
                :container-class="'pagination float-right my-4'"
                :page-class="'page-item'"
                :page-link-class="'page-link'"
                :prev-class="'page-item'"
                :prev-link-class="'page-link'"
                :next-class="'page-item'"
                :next-link-class="'page-link'"
            >
            </paginate>
        </nav>
    </div>
</template>

<script>
export default {
    data() {
        return {
            signatures: [],
            pageCount: 1,
            endpoint: "api/signatures?page="
        };
    },

    created() {
        this.fetch();
    },

    methods: {
        fetch(page = 1) {
            axios.get(this.endpoint + page).then(({ data }) => {
                this.signatures = data.data;
                this.pageCount = data.meta.last_page;
            });
        },

        report(id) {
            if (confirm("Are you sure you want to report this signature?")) {
                axios
                    .put("api/signatures/" + id + "/report")
                    .then(response => this.removeSignature(id));
            }
        },

        removeSignature(id) {
            this.signatures = _.remove(this.signatures, function(signature) {
                return signature.id !== id;
            });
        }
    }
};
</script>
