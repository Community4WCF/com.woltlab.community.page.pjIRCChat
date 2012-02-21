{include file="documentHeader"}
<head>
	<title>{lang}wcf.pjircchat.main{/lang} - {lang}{PAGE_TITLE}{/lang}</title>
	{include file="headInclude"}
</head>
<body{if $templateName|isset} id="tpl{$templateName|ucfirst}"{/if}>
{include file='header' sandbox=false}

<div id="main">

	<ul class="breadCrumbs">
		<li><a href="index.php?page=Index{@SID_ARG_2ND}"><img src="{icon}indexS.png{/icon}" alt="" /> <span>{lang}{PAGE_TITLE}{/lang}</span></a> &raquo;</li>
	</ul>

	<div class="mainHeadline">
		<img src="{icon}pjircchatL.png{/icon}" alt="" />
		<div class="headlineContainer">
			<h2>{lang}wcf.pjircchat.main{/lang}</h2>
			<p>{lang}wcf.pjircchat.information{/lang}</p>
		</div>
	</div>
	
	{if $userMessages|isset}{@$userMessages}{/if}
	
	<div class="border content">
		<div class="container-1">
		<div align="center">
			<applet codebase="{@RELATIVE_WCF_DIR}/lib/page/util/pjIRCChat/" code="IRCApplet.class" archive="irc.jar,pixx.jar" width="{@PJIRCCHAT_WIDTH}" height="{@PJIRCCHAT_HEIGHT}" name="pjirc">
				<param name="CABINETS" value="irc.cab,securedirc.cab,pixx.cab" />
				
				<param name="nick" value="{if $this->user->username}{$PJIRCCHAT_CHECKEDNAME}{else}{@PJIRCCHAT_GUESTNAME}???{/if}" />
				<param name="alternatenick" value="{if $this->user->username}{$PJIRCCHAT_CHECKEDNAME}???{else}{@PJIRCCHAT_GUESTNAME}???{/if}" />
				<param name="name" value="{@PJIRCCHAT_LOGONNAME}" />
				<param name="host" value="{@PJIRCCHAT_HOST}" />
				<param name="port" value="{@PJIRCCHAT_PORT}" />
				<param name="gui" value="pixx" />
				<param name="quitmessage" value="{@PJIRCCHAT_QUITMESSAGE}" />
				<param name="command1" value="/join {@PJIRCCHAT_CHANNELNAME}" />
				{if MODULE_HELP}<param name="pixx:helppage" value="{@PAGE_URL}/index.php?page=Help&item=pjircchat{@SID_ARG_2ND}" />{/if}
				{if $this->language->getLanguageCode()|ucfirst == "En"}<param name="language" value="english">
				<param name="pixx:language" value="pixx-english">{/if}
				{if $this->language->getLanguageCode()|ucfirst == "De"}<param name="language" value="german">
				<param name="pixx:language" value="pixx-german">{/if}
				{if $this->language->getLanguageCode()|ucfirst == "De-informal"}<param name="language" value="german">
				<param name="pixx:language" value="pixx-german">{/if}
				{@PJIRCCHAT_ADVANCED}
				
				<param name="style:bitmapsmileys" value="true">
			</applet>
			
			{if PJIRCCHAT_SMILIES}
			<div class="container-1">
			{foreach from=$smileys item=$smiley}
				<img src="{$smiley->getURL()}" onclick="javascript:document.pjirc.setFieldText(document.pjirc.getFieldText()+'{$smiley->smileyCode} ')" alt="{$smiley->smileyCode}" style="cursor:pointer;"/>
			{/foreach}
			</div>
			{/if}
			
			<div class="container-1">
				<p class="smallFont"><strong>{lang}wcf.pjircchat.server{/lang}:</strong> <a href="irc://{@PJIRCCHAT_HOST}:{@PJIRCCHAT_PORT}/{@PJIRCCHAT_CHANNELNAME}">{@PJIRCCHAT_HOST}</a> / <strong>{lang}wcf.pjircchat.port{/lang}:</strong> {@PJIRCCHAT_PORT} / <strong>{lang}wcf.pjircchat.channel{/lang}:</strong> {@PJIRCCHAT_CHANNELNAME}</p>
				{if PJIRCCHAT_XTRAMSG}
					<p class="smallFont">{lang}{@PJIRCCHAT_XTRAMSG}{/lang}</p>
				{/if}
			</div>
		</div>	
		</div>	
	</div>
	
	{if $additionalBoxes|isset}{@$additionalBoxes}{/if}

</div>
{include file='footer' sandbox=false}
</body>
</html>