<!doctype html>
<html lang="en" ng-app="app">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Cair - Admin Panel</title>
        <meta name="description" content="The admin panel for the Cair cms.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <div ui-view></div>
            </div>
        </div>
        <script type="text/ng-template" id="home.html">
            <ul class="list-unstyled">
                <li ng-repeat="resource in resources">
                    <a ui-sref="collection({ collection: resource })">{{ resource }}</a>
                </li>
            </ul>
        </script>
        <script type="text/ng-template" id="collection.html">
            <h2>{{ collection }}</h2>
            <a ui-sref="home">Back</a>
            <table class="table">
                <thead>
                    <tr>
                        <th ng-repeat="attribute in attributes">{{ attribute }}</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in items">
                        <td ng-repeat="attribute in attributes">{{ item[attribute] }}</td>
                        <td>
                            <button ng-click="delete($index)" class="btn btn-danger">Delete</button>
                            <a ui-sref="item({ collection: collection, item: item.id })" class="btn btn-primary">View</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a class="btn btn-primary" ui-sref="create({ collection: collection, item: item.id })">Add</a>
        </script>
        <script type="text/ng-template" id="create.html">
            <a ui-sref="collection({ collection: collection })">{{ collection }}</a>
            <ul class="list-unstyled">
                <li ng-repeat="attribute in definition.attributes">
                    <div class="form-group">
                        <label class="control-label">{{ attribute }}</label>
                        <textarea ng-if="definition.types[attribute] == 'textarea'" ng-model="item[attribute]" class="form-control">{{ item[attribute] }}</textarea>
                        <input ng-if="definition.types[attribute] == 'text'" ng-model="item[attribute]" type="text" value="{{ item[attribute] }}" class="form-control">
                    </div>
                </li>
            </ul>
            <button ng-click="publish()" class="btn btn-default">Publish</button>
        </script>
        <script type="text/ng-template" id="item.html">
            <a ui-sref="collection({ collection: collection })">{{ collection }}</a>
            <ul class="list-unstyled">
                <li ng-repeat="attribute in definition.attributes">
                    <div class="form-group">
                        <label class="capitalize">{{ attribute }}</label>
                        <textarea ng-if="definition.types[attribute] == 'textarea'" ng-model="item[attribute]" class="form-control" ng-change="change()">{{ item[attribute] }}</textarea>
                        <input ng-if="definition.types[attribute] == 'text'" ng-model="item[attribute]" type="text" value="{{ item[attribute] }}" class="form-control" ng-change="change()">
                    </div>
                </li>
            </ul>
            <button ng-click="submit()" class="btn btn-default" ng-class="{'btn-warning': loading, 'btn-success': success}" style="outline: none" ng-bind-html="btnText"></button>
        </script>
        <?php foreach($scripts as $script) : ?>
            <script src="<?php echo $script ?>"></script>
        <?php endforeach ?>
    </body>
</html>