<!DOCTYPE html PUBLIC -//W3C//DTD XHTML 1.0 Strict//EN http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd>
 <html lang="en">
 <head>
	 <title></title>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="http://localhost:8080/ci/assets/css/bootstrap.css" type="text/css"/>
	 <style>
	 .cari {
	 	width:50%;
	 	margin-bottom:5%;

	 }
   .tambah {
     margin : 2%;
   }

	 </style>
	 <script src="http://localhost:8080/ci/assets/js/react.min.js"></script>
	 <script src=" http://localhost:8080/ci/assets/js/react-dom.min.js"></script>
	 <!--<script src="assets/js/ajax.js"></script>-->
   <script src="http://localhost:8080/ci/assets/js/jquery.min.js">
   </script>
	 <script src="http://localhost:8080/ci/assets/js/browser.min.js"></script>
 </head>
	 <body>
		<div  id="container"></div>
		<script type="text/babel">

			class Cari extends React.Component {
        constructor(props) {
          super(props);
          this.ubah = this.ubah.bind(this);
        }
        ubah(e) {
          this.props.event(e.target.value);
        }
				render() {
					return <input className='form-control cari' type="text" placeholder='search....' value={this.props.value} onChange={this.ubah} />;
				}
			}
			class Row extends React.Component {
				render() {
					return (
						<tr>
							<td>{this.props.nama}</td>
							<td>{this.props.kelas}</td>
							<td>{this.props.act}</td>
						</tr>
					);
				}
			}
      class Tambah extends React.Component {
      	constructor(props) {
      		super(props);
      		this.state = {
      			kelas:"",
      			nama:""
      		};
      		this.nama = this.nama.bind(this);
      		this.kelas = this.kelas.bind(this);
      		this.suhmit = this.submit.bind(this);
      	}
      	nama(e) {
      		this.setState({
      			nama: e.target.value
      		});
      	}
      	kelas(e) {
      		this.setState({
      			kelas: e.target.value
      		});
      	}
      	submit() {
      		this.props.event(this.state.nama,this.state.kelas);
      	}
        render() {
          return (
            <form>
              <input className="form-control tambah" type="text" placeholder="nama" value={this.state.nama} onChange={this.nama} />
              <input className="form-control tambah" type="text" placeholder="kelas" value={this.state.kelas} onChange={this.kelas} />
              <input className="btn btn-primary tambah" type="submit" value="tambah" onClick={this.submit} />
            </form>
          );
        }
      }
			class Crud extends React.Component {
        constructor(props) {
          super(props);
          this.ubah = this.ubah.bind(this);
          this.tambah = this.tambah.bind(this);
          this.state = {
            filter:"",
            data:[],
            status:"",
          };
        }
        tambah(nama,kelas) {
        	$.get("http://localhost:8080/ci/index.php/welcome/tambah/"+nama+"/"+kelas,function(res){
        	this.setState({
        		status: res
        	});
        	}.bind(this));
        }
        ubah(filter) {
          this.setState({
            filter:filter
          });
        }
        componentDidMount() {
          $.get("http://localhost:8080/ci",function(res) {
            this.setState({
              data: JSON.parse(res)
            });
          }.bind(this));

        }
				render() {
					var baris	 = [];
					this.state.data.forEach(data => {
            if(data.nama.indexOf(this.state.filter) === -1 ){
              return;
            }
						baris.push(<Row nama={data.nama} kelas={data.kelas} act='hapus' />);
					});
					return (
						<div className='col-sm-4 col-sm-offset-4'>
						<h1>Tabel CRUD</h1>
							<Cari event={this.ubah} value={this.state.filter} />
							<table className='table table-striped table-responsive'>
							<thead>
								<td>Nama</td>
								<td>Kelas</td>
								<td>aksi</td>
							</thead>
							<tbody>
								{baris}
								</tbody>
							</table>
              <Tambah event={this.tambah} />
						</div>
					);
				}
			}
		//	var data = [{"nama":"nsma","kelas":"ndat "},{"nama":"nursan","kelas":"XII TKJ 2"},{"nama":"ina","kelas":"XII TKJ "},{"nama":"rahmat","kelas":"XII TKJ 1"}];
			ReactDOM.render(
				<Crud />,
				document.getElementById("container")
			);
		</script>
	 </body>
 </html>