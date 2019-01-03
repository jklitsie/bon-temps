<template>
    <div>
        <div class="row form-group">
            <div class="col">
                <label for="groepsgrootte" class="form-label">Groepsgrootte</label>
                <input type="number" name="groepsgroote" :class="[{'is-invalid' : isInvalid },'form-control']" id="groepsgrootte"
                       v-model="groepsgrootte"/>
            </div>
            <div class="col">
                <label for="datum">Datum</label>
                <input name='datum' type="date" :class="[{'is-invalid' : isInvalid },'form-control']" v-model="datum"/>
            </div>
            <div class="col">
                <label for="time">Start tijd</label>
                <input name="start_tijd" type="time" @blur="calcTime" :class="[{'is-invalid' : isInvalid },'form-control']" v-model="startTijd"/>
            </div>
            <div class="col">
                <label for="eind_tijd">Eind tijd</label>
                <input id="eind_tijd" type="time" name="eind_tijd" class="form-control" v-model="eindTijd" readonly>
            </div>
        </div>
        <div class="row form-group">
            <div class="col" v-if="visueelTafels">
                <label for="groepsgrootte" class="form-label">Tafel selectie</label>
                <!--<select id='tafelselect' name="tafel[]" class="custom-select form-control" multiple>
                    <option v-for="tafel in tafels" :value="tafel.tafel_nummer" :disabled="!tafel.bezet">
                        Tafel :{{tafel.tafel_nummer}} stoelen:
                        {{tafel.stoelen}}
                    </option>
                </select>-->
                <div class="custom-control  custom-control-inline" v-for="tafel in tafels" >
                    <input class="custom-checkbox" type="checkbox" name="tafel[]" :value="tafel.tafel_nummer" :disabled="tafel.bezet">
                    Tafel :{{tafel.tafel_nummer}} stoelen:
                    {{tafel.stoelen}}
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import axios from 'axios';
  import * as moment from 'moment';

  export default {
    data() {
      return {
        tafels: [],
        startTijd: '',
        extraTijd: 2,
        eindTijd: '',
        datum: '',
        isInvalid: false,
        visueelTafels: false,
        groepsgrootte: '',
      }
    },
    methods: {
      getTafels() {
        axios.get('/api/tafels').then((response) => {
          response.data.forEach((data) => {
            data.bezet = false;
          });
          this.tafels = response.data;
        });
      },
      getTafelsWithinTime(dataSet) {
        axios.post('/api/tafel/availability', dataSet).then(response => {
          response.data.forEach(data => {
            this.tafels.forEach(tafel => {
              tafel.bezet = false;
              if(tafel.id == data){
                console.log(data);
                tafel.bezet = true;
              }
            });
          });
        });
      },
      calcTime() {
        let setDate = moment(this.datum)
        setDate.add(this.startTijd.slice(0, 2), 'H');
        setDate.add(this.startTijd.slice(3, 5), 'm');
        let compareAfter = moment(this.datum)
          .add('14', 'H');
        let compareBefore = moment(this.datum)
          .add('23', 'H');
        let submit = document.getElementById('submitIets');
        submit.disabled = true;
        if (moment(setDate, 'HH:m').isAfter(compareAfter) && moment(setDate, 'HH:m').isBefore(compareBefore)) {
          // call getTafels en haal alle mogelijke stoelen op
          let dataObj = {}
          dataObj.datum = setDate.format('YYYY-MM-DD H:m');
          dataObj.grootte = this.groepsgrootte;
          this.getTafelsWithinTime(dataObj);
          //set triggers
          submit.disabled = false;
          this.isInvalid = false;
          this.visueelTafels = true;
        } else {
          this.isInvalid = true;
        }
        let computed = moment(this.startTijd, 'HH:mm').add(this.extraTijd, 'h');
        this.eindTijd = moment(computed).format('HH:mm');
      },
    },
    computed: {},
    mounted() {
      this.getTafels();
    },
  }
</script>
