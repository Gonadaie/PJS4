import React from "react";
import ReactDOM from "react-dom";

class AdjectiveContainer extends React.Component {
	
	render(){
		let adj = this.props.adj;
		return (
			<div style={{width: "100%", height: "100%"}}>
				{adj.map(function(name, index){
						return <Adjective wording={name}/>
				})}
			</div>
		);
	}
	
};

class Adjective extends React.Component {

	constructor(props){
		super(props);
		this.x = Math.random()*0.5;
		//this.y = Math.random()*1;
	
		//Act like a static variable	
		if(Adjective.yPos === undefined)
			Adjective.yPos = 0;

		this.y = Adjective.yPos;
		this.size = 2 + Math.random()*2;
		Adjective.yPos += this.size/40;
		this.color = "rgb(" + (Math.random() * 25) + "," + (Math.random() * 25) + "," + (55 + Math.random() * 200) + ")";
		this.state = {display: "block"};
		this.clickHandler = this.clickHandler.bind(this);
	}

	clickHandler(){
		let adj_inputs = document.getElementsByClassName("adj-input");
		let cross_inputs = document.getElementsByClassName("close-cross");

		for (let i = 0; i < adj_inputs.length; ++i){
			if(adj_inputs[i].value === ''){
				adj_inputs[i].value = this.props.wording;
				adj_inputs[i].style.color = this.color;
				cross_inputs[i].style.visibility = "visible"
				this.setState({display: 'none'});
				

				let adj_comp = this;
				let adj_obj = {adj: adj_comp, input: adj_inputs[i]};	
				adj_inputs[i].onclick = function() { 
					this.adj.setState({display: "block"});
					cross_inputs[i].style.visibility = "hidden";
					this.input.value = '';
				}.bind(adj_obj);
				break;
			}
		}
	}

	render(){
		return (
			<div className="adj" onClick={this.clickHandler} style={{
						position: "absolute",
						marginLeft: this.x * 100 + '%',
						marginTop: this.y * 100 + '%',
						fontSize: this.size + 'vw',
						color: this.color,
						display: this.state.display
						}}>
				{this.props.wording}
			</div>
		);
	}
};

function get_adj() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			console.log(this.responseText);
			if(this.responseText != false){
				var json = JSON.parse(this.responseText);
				display_adj(json);
			}
			else
				console.log("Erreur : impossible de charger les adjectifs...");
		}
	};

	xhttp.open("GET", "../controller/get_adjs.php", true);
	xhttp.send();
}

function display_adj(adj) {
	let half = Math.trunc(adj.length/2);
	ReactDOM.render(<AdjectiveContainer adj={adj.splice(0, half)}/>, document.getElementById("left-adj-container"), show_adj);
	Adjective.yPos = 0;
	ReactDOM.render(<AdjectiveContainer adj={adj.splice(0, adj.length)}/>, document.getElementById("right-adj-container"), show_adj);
}

function show_adj() {
	var $adj = $('.adj');
	console.log($adj);
	$adj.each(function(){
		let random_delay = Math.random() * 2000;
		$(this).hide().delay(random_delay).fadeIn(1000);
	});

}

let adj_inputs = document.getElementsByClassName("adj-input");
Array.from(adj_inputs).forEach(function(item) { item.value = "" } );	

let cross_inputs = document.getElementsByClassName("close-cross");

for(let i = 0; i < cross_inputs.length; ++i) {
	cross_inputs[i].onclick = function() { adj_inputs[i].click(); };
}

get_adj();
