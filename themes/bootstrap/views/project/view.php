<?php
/*
 * This file is part of
 *     ____              _ __
 *    / __ )__  ______ _(_) /_____  _____
 *   / __  / / / / __ `/ / __/ __ \/ ___/
 *  / /_/ / /_/ / /_/ / / /_/ /_/ / /
 * /_____/\__,_/\__, /_/\__/\____/_/
 *             /____/
 * A Yii powered issue tracker
 * http://bitbucket.org/jacmoe/bugitor/
 *
 * Copyright (C) 2009 - 2013 Bugitor Team
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation files
 * (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge,
 * publish, distribute, sublicense, and/or sell copies of the Software,
 * and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
 * DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT
 * OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE
 * OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
?>
<?php
$this->pageTitle = $model->name . ' - Overview - ' . Yii::app()->name;
?>
<div id="project-view" class="row-fluid">
<div class="contextual">
    <?php
    if (((Yii::app()->controller->id === 'project') || (Yii::app()->controller->id === 'issue')) && (isset($_GET['identifier']))) {
        $new_GET = $_GET;
        unset($new_GET['projectname']);
        if (('issue/view' !== $this->route) && ('issue/update' !== $this->route) && ('issue/create' !== $this->route)) {
            $this->widget('DropDownRedirect', array(
                'data' => Yii::app()->controller->getProjects(),
                'url' => $this->createUrl($this->route, array_replace($new_GET, array('identifier' => '__value__'))),
                'select' => $_GET['identifier'], //the preselected value
                'htmlOptions' => array('style' => 'width:120px !important', 'class' => 'pull-right'),
            ));
        }
    }
    ?>
</div>
	<h3 class="overview-icon">Overview</h3>

<div class="row-fluid">
	<div id="splitcontentleft" class="span6">
		<br/>
		<div class="project box">
			<?php $this->widget('ProjectBox', array('project' => $model)) ?>
		</div>
		<div class="roadmap box">
		    <?php $milestone_limit = 2; ?>
		    <?php $open_milestone_count = Milestone::getOpenMilestoneCount($model->id); ?>
		    <?php if($open_milestone_count < 2) $milestone_limit = $open_milestone_count; ?>
		    <h3 class="roadmap-icon">Roadmap <small>(Showing <?php echo $milestone_limit; ?> <?php echo ((1 == $open_milestone_count) ? 'milestone' : 'milestones') ?> out of <?php echo $open_milestone_count; ?> open)</small></h3>
			<?php $this->widget('Roadmap', array('milestones' => $model->milestones, 'identifier' => $model->identifier)) ?>
		</div>
		<div class="members box">
			<h3 class="members-icon">Members</h3>
			<?php $this->widget('ProjectMembers', array('project' => $model)) ?>
		</div>
	</div>
	<div id="splitcontentright" class="span6">
		<br/>
		<div class="issues box">
			<h3 class="issues-icon">Issues</h3>
			<?php $this->widget('ProjectIssuesByTracker', array('project' => $model)) ?>
		</div>
		<div class="activity box">
			<h3 class="activity-icon">Recent Activity</h3>
			<?php $this->widget('ProjectActivity', array('projectId' => $model->id, 'displayLimit' => 5)); ?>
		</div>
	</div>
</div>
</div>
