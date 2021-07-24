<template>
  <div>
    <div
      class="card text-left mb-5 box-shadow p-3 border-0 rounded-lg"
      style="min-height: 400px"
    >
      <div class="card-body p-1 p-lg-3 pt-4">
        <div
          class="
            d-flex
            justify-content-between
            align-items-center
            mb-4
            flex-column flex-md-row
          "
        >
          <h4 class="card-title-text mb-0 text-center">Monthly Expenses</h4>
        </div>
        <div class="row">
          <div class="col-12 col-lg-11 filter-grid">
            <div class="row">
              <div class="col d-flex align-items-center">
                <div class="form-group mr-2">
                  <label>From</label>
                  <input
                    type="date"
                    class="form-control rounded-0"
                    v-model="form.from"
                  />
                </div>
                <div class="form-group mr-2">
                  <label>To</label>
                  <input
                    type="date"
                    class="form-control rounded-0"
                    v-model="form.to"
                  />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group mr-2">
                  <label for>Category</label>
                  <div class="select-custom-arrow">
                    <select
                      class="form-control rounded-0"
                      name="community"
                      v-model="form.selected_category"
                    >
                      <option
                        v-for="cat in categories"
                        :key="cat.id"
                        v-text="cat.name"
                        :value="cat.id"
                      ></option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">

                <div class="col form-group">
                  <button
                    type="button"
                    class="btn rounded-0 btn-sm btn-primary"
                    @click="updateData()"
                  >
                    Search
                  </button>
                </div>
            </div>
          </div>
        </div>
        <span>
          <small v-text="date_error"></small>
        </span>
        <canvas style="max-height:300px" id="myChart" class="mt-1 mt-lg-5 mb-3"></canvas>
      </div>
    </div>
  </div>
</template>

<script>
import Chart from "chart.js/auto";
import moment from "moment";

export default {
  props: ["categories"],
  data() {
    return {
      chart_data: { values: [], labels: [] },
      chart: null,
      form: {
        from: new Date(),
        to: null,
        selected_category: this.categories[0].id,
      },
      date_error: "",
    };
  },
  mounted() {
    let date = new Date().toJSON().slice(0, 10);
    this.form.to =
      date.slice(0, 4) + "-" + date.slice(5, 7) + "-" + date.slice(8, 10);
    let last_year = String(Number(date.slice(0, 4)) - 1);
    this.form.from =
      last_year + "-" + date.slice(5, 7) + "-" + date.slice(8, 10);

    this.updateData();
  },
  methods: {
    updateData() {
      // check that the to and from dates are in the right order
      if (moment(this.form.from).isAfter(this.form.to)) {
        this.date_error =
          "Please make sure your dates are in the correct order.";
        return;
      } else {
        this.date_error = "";
      }

      var url = "/logs?category_id=" + this.form.selected_category;

      // get the invoice data
      axios.get(url).then((response) => {
        this.chart_data = { values: [], labels: [] };
        // for each month between the to and from dates
        let date = moment(this.form.from);
        let end_date = moment(this.form.to);
        let monthly_total = 0;
        while (!date.isAfter(end_date)) {
          // set x coordinate
          this.chart_data.labels.push(date.format("Y-MM"));
          // check if there is any data for this month
          let points = response.data.filter(
            (p) => p.date.substring(0, 7) == date.format("Y-MM")
          );
          // for each invoice sent out this month, combine to total cost
          monthly_total = 0;
          points.forEach((point) => {
            monthly_total += point.cost;
          });
          this.chart_data.values.push(monthly_total);

          date.add(1, "M");
        }

        this.updateChart();
      });
    },
    updateChart() {
      // show the most recent data in the chart
      if (!this.chart) {
        this.initChart();
      } else {
        this.chart.data.labels = this.chart_data.labels;
        this.chart.data.datasets[0] = { data: this.chart_data.values };
        this.chart.update();
      }
    },
    initChart() {
      var ctx = document.getElementById("myChart").getContext("2d");
      this.chart = new Chart(ctx, {
        type: "line",
        data: {
          labels: this.chart_data.labels,
          datasets: [{ data: this.chart_data.values }],
        },
        options: {
          plugins: {
            legend: {
              display: false,
            },
            tooltip: {
              callbacks: {
                label: function (context) {
                  return "";
                },
                title: function (context) {
                  return context[0].parsed.y;
                },
              },
            },
          },
        },
      });
    },
  },
};
</script>


