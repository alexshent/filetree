
let hostName = window.location.hostname;

async function getRootData() {
    let url = `http://${hostName}/ajax/root`;
    let response = await fetch(url);
    let result = await response.json();
    return result.root;
}

async function getChildrenData(parentId) {
    let url = `http://${hostName}/ajax/children/${parentId}`;
    let response = await fetch(url);
    let result = await response.json();
    return result.children;
}

function buildNodeContent(nodeId) {
    let directoryIds = [];
    
    getChildrenData(nodeId).then(
    children => {
        let childrenHtml = '<ul>';
        
        children.forEach(function callback(currentValue, index, array) {
            let icon = '';
            let nodeIdHtml = 'id' + currentValue.node_id;
            
            if (currentValue.type == 'link') {
                childrenHtml += `<li><span class="link-node"><i class="far fa-file"></i><a href="#!">${currentValue.name}</a></span></li>`;
            }
            else if (currentValue.type == 'file') {
                childrenHtml += `<li><span class="file-node"><i class="far fa-file"></i><a href="#!">${currentValue.name}</a></span></li>`;
            }
            else if (currentValue.type == 'directory') {
                directoryIds.push(currentValue.node_id);
                childrenHtml += `
                <li>
                <span class="dir-node"><a style="color:#000; text-decoration:none;" data-toggle="collapse" href="#${nodeIdHtml}" aria-expanded="false" aria-controls="${nodeIdHtml}"><i class="collapsed"><i class="fas fa-folder"></i></i><i class="expanded"><i class="far fa-folder-open"></i></i>${currentValue.name}</a></span>
                <div id="${nodeIdHtml}" class="collapse">
                </div>
                </li>`;
            }
        });
        
        childrenHtml += '</ul>';
        $('#id' + nodeId).html(childrenHtml);
        
        directoryIds.forEach(id => {
            setCollapseHandler(id);
    });
    });
}

function setCollapseHandler(nodeId) {
    $('#' + nodeId).on('show.bs.collapse', buildNodeContent(nodeId));
}

getRootData().then(
    root => {
        let rootId = 'id' + root.node_id;
        rootHtml = `
        <ul>
        <li>
        <span class="dir-node"><a style="color:#000; text-decoration:none;" data-toggle="collapse" href="#${rootId}" aria-expanded="true" aria-controls="${rootId}"><i class="collapsed"><i class="fas fa-folder"></i></i><i class="expanded"><i class="far fa-folder-open"></i></i>${root.name}</a></span>
        <div id="${rootId}" class="collapse show">
        </div>
        </li>
        </ul>
        `;
        $("div.tree").html(rootHtml);
        buildNodeContent(root.node_id);
    }
);
