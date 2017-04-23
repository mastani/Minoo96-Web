<link rel="stylesheet" href="{$smarty.const.DEFAULT_PATH}/Theme/CSS/bootstrap_table.css">

{include file="./sidebar.tpl"}
<div class="col-md-9">
  <div class="profile-content">
    <div class="col-md-12">
     {if isset($msg)}
         <div class="alert alert-info" id="message"><ul>
             {foreach $msg as $message}
                <li>{$message}</li>
             {/foreach}
         </ul></div>
     {/if}
     {if $url == 'posts'}
         {include file="./posts.tpl"}
     {elseif $url == 'new'}
         {include file="./newpost.tpl"}
     {elseif $url == 'bio'}
         {include file="./bio.tpl"}
     {elseif $url == 'setting'}
         {include file="./setting.tpl"}
     {/if}
<!-- below tags for sidebar -->

        <script>
            $('#message').delay(3000).fadeOut();
        </script>
    </div>
  </div>
</div>
</div>
