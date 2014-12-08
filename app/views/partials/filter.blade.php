<div id="masterFilter">

    <div class="widget">
        <h3 class="title"><i class="icon-tasks"></i> &nbsp;Catégories</h3>

           @if(!empty($categories))
              <select id="select2" name="category_check">
                  @foreach($categories as $categorie)
                     <option value="{{ $categorie->id }}">{{ $categorie->title }}</option>
                  @endforeach
              </select>
          @endif

    </div><!--END WIDGET-->

    <div class="widget">
        <h3 class="title"><i class="icon-calendar"></i> &nbsp;Années</h3>
        @if(!empty($annees))
            @foreach($annees as $annee)
                <input type="radio" name="annee" value="{{ $annee }}"><label>{{ $annee }}</label>
            @endforeach
        @endif
    </div><!--END WIDGET-->

</div><!--END SIDEBAR-->

<p class="divider-border"></p>
