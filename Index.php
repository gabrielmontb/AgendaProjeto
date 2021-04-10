<?php  

include("connection.php");
$consulta = "SELECT * FROM dados ORDER BY nome asc";
$con = $mysqli->query($consulta) or die($mysqli->error);
?>



<html>
    <head>    
        <script type="text/javascript" src="Jquerry.js"></script> 
        <script type="text/javascript" src="bootstrap.js"></script>             
        <link rel="stylesheet" type="text/css" href="bootstrap.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
        <title>Visualizar agenda virtual</title>
    </head> 
    <style>
      #p1 {background-color:hsl(120, 90%, 50%);}
      #p2 {background-color:hsl(0, 90%, 50%);}    
      #p3 {background-color:rgb(248,248,255);}  
      #p4 {background-color:rgb(230,250,255);}
      
    </style>  
    <body id = "p3">
      <div class="hero-image">
        <div align = "center" class="hero-text">
          <h1 style="font-size:50px">Agenda virtual</h1>
          <h3>Simples, rápida e prática!</h3>
        </div>
      </div>
      <form align = "center">          
          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Adicionar contato 
          </button>
          <form>
            <div class="collapse" id="collapseExample">
            <div class="card card-body"> </div>
            <span> Nome: </span></br>
            <input type="text" id="nome_adc"/></br>
            <span> Telefone: </span></br>
            <input maxlength="11" type="text" id="telefone_adc"/></br>
            <button id="salvar_ctt">Salvar</button>
            <div id= "mensagens"></div>
            </div>          
          </form>
        </form>
   		
        <table border="2" align = "center" id="p4">
            <br>            
            <td align = "center"><b>Nome</b></td>
            <td align = "center"><b>Telefone</b></td>  
            <td align = "center"><b>Ação</b></td>      
            </tr>
             <?php while($dados = $con->fetch_array()){ ?>
              <tr id="linha<?= $user->id ?>">
                 <td><?php echo $dados["nome"]; ?></td>
                 <td><?php echo $dados["telefone"];?></td>
                 <td>
                    <button type="button" id="p1" onclick="updateAjax(<?php echo $dados['ID'] ?>)" data-toggle="modal" class="btn btn-default" data-target="#editar_modal">Editar</button>
                    <button type="button" id="p2" onclick="deleteAjax(<?php echo $dados['ID'] ?>)" id="excluir_user" class="btn btn-default" > Excluir</button>             
                 </td>
                 <div id= "mensagens"></div>
            </tr>         

        <?php }?>
        </table>
        <!-- Modal -->
        <div id="editar_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title">Editar contato</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
              <span> Nome: </span></br>
              <input type="text" id="nome_e"/>
              <br/>
              <span> Telefone: </span></br>
              <input type="text" id="telefone_e" maxlength="11"/>
              <br/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Voltar</button>
                <button id="confirmar_edicao" type="button" class="btn btn-default" data-dismiss="modal">Editar</button>
              </div>
            </div>     

    </body>
</html>
<script type="text/javascript">

$(document).ready(function(){
      $("#salvar_ctt").on('click',function(e){
    e.preventDefault();
      $.ajax({
        url: "Post.php",
        method: "POST",
        data:{
          nome:$("#nome_adc").val(),
          telefone:$("#telefone_adc").val(),
        },
        datatype: "json",
        success:function(data){
          $("#mensagens").html(data);
              $('#nome').val('');
              $('#telefone').val('');
              location.reload();
        },        
        error:function(data){
          $("#mensagens").html("Não editado!");
        },
      })
    });

});

function updateAjax(id){
  $(document).on('click',"#confirmar_edicao",function(e){
    e.preventDefault();
      $.ajax({
      url: "put.php",
      method: "POST",
      data:{
        nome_d:$("#nome_e").val(),
        telefone_d:$("#telefone_e").val(),
        delete_id:id,
    },
    dataType:"json",
    success:function(data){
        $("#mensagens").html(data);
        $("#mensagens").html("Editado com sucesso!");
        $('#nome_e').val('');
        $('#telefone_e').val('');
       location.reload();
    },        
    error:function(data){
      $("#mensagens").html("Não editado!");
    },
  })
});
}
  function deleteAjax(id){
    if(confirm('Deseja realmente deletar?')){
        $.ajax({
          type:'post',
          url: 'delete.php',
          data:{delete_id:id},
          success:function(data){
            $("#mensagens").html(data);
            $("#mensagens").html("Deletado!!!");
              //$('delete'+id).hide(id);
              $("#linha"+id).remove();
              location.reload();
          },
       });
    }
}

</script>