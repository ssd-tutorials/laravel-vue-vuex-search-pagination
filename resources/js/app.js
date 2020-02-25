import Vue from 'vue';
import store from './store/index';
import SelectAngle from './components/Form/SelectAngle';
import TimesCircle from './components/Icons/TimesCircle';

import SearchForm from './components/Search/SearchForm';
import SearchResults from './components/Search/SearchResults';
import SearchPagination from './components/Search/SearchPagination';

const app = new Vue({
    store,
    el: '#app',
    components: {
        TimesCircle,
        SelectAngle,
        SearchForm,
        SearchResults,
        SearchPagination
    }
});
