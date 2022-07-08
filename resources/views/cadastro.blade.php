<html>

    <head></head>
    <body>
        <div>
            <form name="cadastro" id="cadastro" method="post" action="{{cadastro}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input type="text" id="title" name="name" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">DT_NASCIMENTO</label>
                    <input type="date" id="data" name="data" class="form-control" required="">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </body>
</html>