findInList([["azert","qsdf","wxcv"],["azert","qsdf","wxcv"],["azert","qstestdf","wxcv"]],"te");

function findInList(lists, word){
	lists.forEach(function(list){
		list.forEach(function(item){
			if(item.includes(word)){
				console.log(list);
			}
   	}
    );
  }
	);
}