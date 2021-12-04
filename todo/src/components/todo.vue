<template>
  <!-- <center><h1>Todo soufiane ekouines </h1> </center>  -->
  <div class="container"><h2 class="text-center mt-5">TODO SOUFIANE EKOUINES</h2>
  <div class="d-flex">
    <input v-model="task" type="text" placeholder="Enter task" class="form-control" id="go">
    <button @click="add" class="btn btn-warning rounded-0 pointer">{{yo}}</button>
  </div>
  <table class="table table-bordered mt-5">
  <thead>
    <tr>
      <th scope="col">Task</th>
      <th scope="col">Status</th>
      <th scope="col">#</th>
      <th scope="col">#</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(task,index) in tasks" :key="index">
      <td>{{task.name}}</td>
      <td><span  @click="ch(index)" class="pointer"> {{task.status}}</span></td>
      <td><div  @click="updat(index)" class="text-center pointer"><span class="fa fa-pen"></span></div></td>
      <td><div @click="delet(index)" class="text-center pointer"><span class="fa fa-trash"></span></div></td>
    </tr>
  </tbody>
</table>
  </div>
</template>

<script>
export default {
  name: 'HelloWorld',
  props: {
    msg: String
  },
  data() {
    return {
     editts:null,
     task:'',
     yo:'Add',
     stat:['to-do','in-progress','finished'],
      tasks:[
        {
          name:"nbchii o nji",
          status:'to-do'
        },
        {
          name:"nakol o nchrob",
          status:'in-progress'
        }
      ]
    }
  },
  methods: {
    add(){
    if(this.task.length===0)return;

    if(this.editts===null){
      this.tasks.push({
        name:this.task,
        status:"to-do"})
        this.task="";
        }else{
          this.tasks[this.editts].name=this.task;
          this.editts=null;
          this.task="";
      this.yo="Add";

        }
      
    },
    delet(index){
      this.tasks.splice(index,1);
    },
    updat(index){
      // if(this.task.length===0)return;
      this.task=this.tasks[index].name
      this.editts=index;
      this.yo="update";
    }
  },
  ch(index){
    // let newi=this.stat.indexOf(this.tasks[index].status);
    // if(++newi>2)newi=0;
    let newi=2;
    this.tasks[index].status=this.stat[newi];
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.pointer{
  cursor:pointer;
}
.f{
  text-decoration:line-through;
}
</style>
