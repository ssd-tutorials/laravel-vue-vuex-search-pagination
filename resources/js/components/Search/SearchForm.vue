<script>
import { debounce } from 'lodash';
import { mapActions } from 'vuex';
export default {
    name: 'SearchForm',
    props: {
        group: {
            type: String,
            required: true
        },
        url: {
            type: String,
            required: true
        },
        method: {
            type: String,
            default: 'get'
        },
        params: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            fields: { ...this.params },
            processing: false
        };
    },
    created() {
        this.initiate({
            group: this.group,
            url: this.url,
            method: this.method,
            params: this.fields
        }).then(value => {
            this.fields = value;
        });
    },
    methods: {
        ...mapActions('search', ['initiate', 'store', 'reset']),
        update: debounce(function() {
            this.change();
        }, 500),
        change() {
            this.processing = true;
            this.store({
                group: this.group,
                params: this.fields
            }).then(() => (this.processing = false));
        },
        clear(fields) {
            this.reset({
                group: this.group,
                params: { ...this.fields, ...fields }
            }).then(value => {
                this.fields = value;
            });
        }
    },
    render() {
        return this.$scopedSlots.default({
            params: this.fields,
            update: this.update,
            change: this.change,
            clear: this.clear,
            processing: this.processing
        });
    }
};
</script>
