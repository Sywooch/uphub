Index: index.php
===================================================================
--- index.php	(revision 87)
+++ index.php	(working copy)
@@ -27,7 +27,14 @@
 
             'id',
             'name',
-            'image',
+            [
+             'attribute'=>'image',
+            'value'=>function ($model) {
+				return Html::img("http://res.ict.up.ac.th/images/" . $model->image);
+			},
+            'format'=>'raw'
+            		
+    ],
 
             ['class' => 'yii\grid\ActionColumn'],
         ],
