Vue.component('paginacion', {
  page:1,
  template: `
  <nav>
        <ul class="pagination">
            <li class="pagination__navigation "
            v-bind:class="[pagination.current_page > 1? '' :'pagination__navigation--disabled']">
                <a href="#" aria-label="Previous"
                   @click.prevent="changePage(pagination.current_page - 1)">
                    <i aria-hidden="true" class="icon material-icons">chevron_left</i>
                </a>
            </li>

            <li class="pagination__navigation " v-for="page in pagesNumber"
                v-bind:class="[ page == isActived ? 'pagination__item--active indigo colorWhite' : '']">
                <a href="#"
                   @click.prevent="changePage(page)">{{ page }}</a>
            </li>
            <li  class="pagination__navigation "
              v-bind:class="[pagination.current_page < pagination.last_page? '' :'pagination__navigation--disabled']">
                <a href="#" aria-label="Next"
                   @click.prevent="changePage(pagination.current_page + 1)">
                  <i aria-hidden="true" class="icon material-icons">chevron_right</i>
                </a>
            </li>
        </ul>
    </nav>
  `,
  props:{
    pagination: {
      total: 0,
      per_page: 4,
      from: 1,
      to: 0,
      current_page: 1
    },
      offset: {
          type: Number,
          default: 4
      }

  },
  computed: {
        isActived: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function () {

            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            // console.log(this.offset);
            return pagesArray;
        }
    },
    methods : {

        changePage: function (page) {
            this.pagination.current_page = page;
            this.$emit('paginate');
        }
    }
});
