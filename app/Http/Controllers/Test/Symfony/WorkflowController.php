<?php
namespace App\Http\Controllers\Test\Symfony;

use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Workflow\Transition;
use Symfony\Component\Workflow\MarkingStore\MethodMarkingStore;
use Symfony\Component\Workflow\Workflow;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\SupportStrategy\InstanceOfSupportStrategy; // 支持的策略

use Acme\Entity\BlogPost;
use Acme\Entity\Newsletter;

class WorkflowController extends Controller {
    public function index() {
    	$definitionBuilder = new DefinitionBuilder();
        $definition = $definitionBuilder->addPlaces(['draft', 'reviewed', 'rejected', 'published']) // 草稿 复查 拒绝 已发布
            ->addTransition(new Transition('to_review', 'draft', 'reviewed')) // 提交
            ->addTransition(new Transition('publish', 'reviewed', 'published')) // 发布
            ->addTransition(new Transition('reject', 'reviewed', 'rejected')) // 拒绝
            ->build()
        ;

        $singleState = true;
        $property = 'currentState';
        $marking = new MethodMarkingStore($singleState, $property);

        $workflow = new Workflow($definition, $marking);


        $blogPostWorkflow = new Workflow($definition, $marking);
        $newsletterWorkflow = new Workflow($definition, $marking);

        $registry = new Registry();
        $registry->addWorkflow($blogPostWorkflow, new InstanceOfSupportStrategy(BlogPost::class));
        $registry->addWorkflow($newsletterWorkflow, new InstanceOfSupportStrategy(Newsletter::class));


        $blogPost = new BlogPost();
        $workflow = $registry->get($blogPost);

        $workflow->can($blogPost, 'publish'); // False
        $workflow->can($blogPost, 'to_review'); // True

        $workflow->apply($blogPost, 'to_review'); // 应用

        $workflow->can($blogPost, 'publish'); // True
        $workflow->getEnabledTransitions($blogPost); // publish reject

    }
}
// ## symfony 命令
// php bin/console workflow:dump workflow-name | dot -Tsvg -o graph.svg
// php bin/console workflow:dump workflow-name | dot -Tpng -o graph.png
// php bin/console workflow:dump workflow_name --dump-format=puml | java -jar plantuml.jar -p > graph.png
// php bin/console workflow:dump workflow-name place1 place2 | dot -Tsvg -o graph.svg

// $dumper = new GraphvizDumper();
// $dumper = new StateMachineGraphvizDumper();
// $dumper = new PlantUmlDumper();
// echo $dumper->dump($definition);
