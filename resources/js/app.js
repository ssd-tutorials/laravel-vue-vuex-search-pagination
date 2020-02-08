import Vue from 'vue';
import AngleLeft from './components/Icons/AngleLeft';
import DoubleAngleLeft from './components/Icons/DoubleAngleLeft';
import AngleRight from './components/Icons/AngleRight';
import DoubleAngleRight from './components/Icons/DoubleAngleRight';
import TimesCircle from './components/Icons/TimesCircle';
import SelectAngle from './components/Form/SelectAngle';

const app = new Vue({
    el: '#app',
    components: {
        AngleLeft,
        DoubleAngleLeft,
        AngleRight,
        DoubleAngleRight,
        TimesCircle,
        SelectAngle
    }
});
