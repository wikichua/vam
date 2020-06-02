Vue.filter("strToUpper", function(text) {
	return text.charAt(0).toUpperCase() + text.slice(1);
})

import moment from 'moment';

Vue.filter("formatDate", function(date) {
	return moment(date).format('MMMM Do YYYY');
})